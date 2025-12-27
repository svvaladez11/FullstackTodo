import createServer from "#server/createServer";
import dotenv from "dotenv";
import { ApiCache } from "#server/cache/apiCache";

dotenv.config();

const port = Number(process.env.PORT) || 3000;
const isProduction = process.env.NODE_ENV === 'production';

const cache = new ApiCache();

setInterval(() => {
    cache.clear();
}, 3_000);

const app = await createServer(isProduction, cache);

app.listen(port, () => {
    console.log(`Server started at http://localhost:${port}`);
});
