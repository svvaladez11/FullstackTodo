import {ResponseImage} from "@/shared/types/api";

export type PositiveNumber = number & { __brand: "PositiveNumber" };

export type IntRange<
    Min extends number,
    Max extends  number
> = number & { __brand: `Int_Range_${Min}_${Max}` };


export type Links = {
    current_page: number
    per_page: number
    total: number
    last_page: number
    links: {
        prev: string | null
        next: string | null
    }
}

export type GvozdBlogTag = {
    id: string
    title: string
    slug: string
    gvozd_blog_post_ids: string[]
    created_at: string
    updated_at: string
}

export type GvozdServiceCategory = {
    id: string
    title: string
    created_at: string
    updated_at: string
}

export type GvozdService = {
    id: string
    title: string
    gvozd_room_ids: string[]
    gvozd_service_category_id: string
    created_at: string
    updated_at: string
}

export type GvozdBedType = {
    id: string
    title: string
    number_of_sleeping_places: number
    width: number
    length: number
    gvozd_room_ids: string[]
    created_at: string
    updated_at: string
}

export type ImageSet = {
    large: Image
    middle: Image
    small: Image
}

export type Image = {
    path: string
    url: string
}

export interface Slide {
    id: string;
    image: ImageSet
}

export type Price = {
    people: PositiveNumber
    price: PositiveNumber
    discount?: IntRange<1, 100>
}
