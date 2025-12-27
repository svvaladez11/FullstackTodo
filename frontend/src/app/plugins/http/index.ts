import axios from "axios";

export default function createHttpPlugin(baseURL: string) {
    return axios.create({
        baseURL
    });
}