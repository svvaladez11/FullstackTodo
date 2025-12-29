import {User} from "@/entities/user/types/model/store";

export interface ResponseWithUser {
    user: User
}

export interface RespondWithToken {
    access_token: string
    token_type: string
    expires_in: number
}