import { js, setPublicPath } from 'laravel-mix';

js('src/app.js', 'dist/js')
    .vue();

setPublicPath('../address-book/public');