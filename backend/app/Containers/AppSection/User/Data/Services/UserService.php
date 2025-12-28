<?php

namespace App\Containers\AppSection\User\Data\Services;

use App\Containers\AppSection\User\Contracts\Data\Repositories\UserRepositoryContract;
use App\Containers\AppSection\User\Data\Dto\RegisterUser\RegisterUserDto;
use App\Containers\AppSection\User\Exceptions\NotFoundUserException;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Support\Services\ImageService;
use Illuminate\Http\UploadedFile;

/**
 * @phpstan-import-type ImageArray from ImageService
 * @phpstan-type StoreDataArray array{
 *     first_name: non-empty-string,
 *     last_name: non-empty-string,
 *     middle_name: non-empty-string,
 *     login: non-empty-string,
 *     role: int<0,2>,
 *     password: non-empty-string,
 *     avatar: UploadedFile,
 * }
 * @phpstan-type UpdateDataArray array{
 *     first_name: non-empty-string,
 *     last_name: non-empty-string,
 *     middle_name: non-empty-string,
 *     login: non-empty-string,
 *     role: int<0,2>,
 *     password?: non-empty-string,
 *     avatar?: UploadedFile,
 * }
 * @phpstan-type PreparedStoreDataArray array{
 *     first_name: non-empty-string,
 *     last_name: non-empty-string,
 *     middle_name: non-empty-string,
 *     login: non-empty-string,
 *     role: int<0,2>,
 *     password: non-empty-string,
 *     avatar: ImageArray,
 * }
 */
final readonly class UserService
{
    public function __construct(
        private UserRepositoryContract $repository,
    ) {
    }

    /**
     * @phpstan-param RegisterUserDto $user
     * @phpstan-return User
     */
    public function create(RegisterUserDto $user): User
    {
        $data = $user->toArray();
        unset($data['password_confirm']);
        return User::create($data);
    }

    /**
     * @phpstan-param non-empty-string $id
     * @phpstan-param StoreDataArray $data
     * @phpstan-return bool
     * @throws NotFoundUserException
     */
    public function update(string $id, array $data): bool
    {
        $user = $this->repository->findByField(
            field: 'id',
            value: $id,
            select: ['avatar'],
        ) ?? throw new NotFoundUserException();
        $avatarIsSet = isset($data['avatar']);
        if ($avatarIsSet) {
            $avatar = new ImageService()
                ->setPath('avatars')
                ->update(
                    file: $data['avatar'],
                    oldFilePaths: json_decode($user->avatar, true),
                    default: 'images/avatars/default.webp'
            );
            $data['avatar'] = json_encode($avatar);
        }
        return $this->repository
            ->findByField('id', $id)
            ->update($data);
    }

    /**
     * @phpstan-param non-empty-string $id
     * @phpstan-return bool
     * @throws NotFoundUserException
     */
    public function delete(string $id): bool
    {
        $user = $this->repository->findByField(
            field: 'id',
            value: $id,
            select: ['avatar'],
        ) ?? throw new NotFoundUserException();
        new ImageService()
            ->setPath('avatars')
            ->delete(
                filePaths: json_decode($user->avatar, true),
                default: 'images/avatars/default.webp'
            );
        return User::destroy($id);
    }
}
