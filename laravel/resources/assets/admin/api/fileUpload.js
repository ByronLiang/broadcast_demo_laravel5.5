import imgHandle from 'common/helpers/imgHandle';
import {uploadToken} from './Cache';

export default class {
    constructor(uploadBasePath = '', drive = 'qiniu') {
        this.uploadBasePath = uploadBasePath;
        this.drive = drive;
    }

    /**
     * 设置图片压缩选项
     * @param imgOptions
     */
    imgOptions(imgOptions) {
        this.imgOptions = imgOptions;
        return this;
    }

    /**
     * 设置ajax请求选项
     * @param ajaxOptions
     */
    ajaxOptions(ajaxOptions) {
        this.ajaxOptions = ajaxOptions;
        return this;
    }

    /**
     * 设置上传文件
     * @param files
     */
    files(files) {
        if (typeof files.length === 'undefined') files = [files];
        this.files = files;
        return this;
    }

    /**
     * 获取上传进度获取
     * @param callback
     */
    onUploadProgress(callback) {
        if (!this.ajaxOptions) this.ajaxOptions = {};
        this.ajaxOptions.onUploadProgress = callback;
        return this;
    }

    /**
     * 获取上传参数
     * @param drive
     * @returns {Promise<*>}
     */
    uploadParameter(drive) {
        if (drive) this.drive = drive;
        return uploadToken(this.drive);
    }

    /**
     * 开始批量上传
     * @param files
     * @returns {Promise<Array>}
     */
    async uploadStart(files) {
        if (files) this.files(files);

        let filesUrl = [];
        for (let i = 0; i < files.length; i++) {
            filesUrl.push(await this.uploadFile(files[i]));
        }
        return filesUrl;
    }

    /**
     * 上传单个文件
     * @param file
     * @returns {Promise<*>}
     */
    async uploadFile(file) {
        let uploadPath = this.uploadBasePath;
        const uploadParameter = await this.uploadParameter();
        const uploadForm = uploadParameter.form;

        if (file.type.includes('image') && !file.type.includes('gif') && this.imgOptions) {
            const newFile = await imgHandle(file, this.imgOptions);
            newFile.name = file.name;
            file = newFile;
        }

        const ext = file.name.split('.').pop();
        const filename = (new Date()).getTime() + '.' + ext;
        uploadPath += filename;

        let formData = new FormData();
        formData.append('file', file, filename);
        for (const key in uploadForm) {
            if (!{}.hasOwnProperty.call(uploadForm, key)) continue;
            formData.append(key, uploadForm[key]);
        }
        formData.append('key', uploadPath);

        await axios.post(uploadParameter.upload_url, formData, this.ajaxOptions);

        return uploadParameter.domain + uploadPath;
    }
}
