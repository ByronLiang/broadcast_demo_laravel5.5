import loadjs from 'loadjs';

loadjs('https://cdn.jsdelivr.net/npm/tinymce@4/tinymce.min.js', 'tinymce');

export default (key, options = {}) => {
    return new Promise((resolve, reject) => {
        loadjs.ready(key, {
            success: resolve,
            error: reject,
            ...options,
        });
    });
};
