export interface User {
    id: number
    login: string
    created_at: string
    updated_at: string
}

export interface AuthState {
    user: User | null
    token: string | null
    isAuthenticated: boolean
}