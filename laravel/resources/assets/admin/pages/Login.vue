<template>
    <div class="login-page">
        <el-card>
            <div slot="header" class="text-center text-xl">{{ $store.state.site_title }}</div>
            <el-form :model="form" :rules="rules" ref="form" label-position="top" @keyup.enter.native="login">
                <el-form-item prop="phone">
                    <el-input :autofocus="true" placeholder="请输入手机号" v-model="form.phone"></el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input placeholder="请输入密码" type="password" v-model="form.password"></el-input>
                </el-form-item>
                <el-form-item class="flex items-center">
                    <el-input class="mr-1 captcha" placeholder="输入验证码" v-model="form.captcha"></el-input>
                    <img :src="captcha" @click="createCaptchaUrl">
                </el-form-item>
                <el-form-item>
                    <el-switch v-model="form.remember" active-text="下次免登录"></el-switch>
                    <router-link class="float-right" to="/reset-passwd">
                        <el-button type="text">忘记密码</el-button>
                    </router-link>
                </el-form-item>
                <el-form-item class="center">
                    <el-button type="primary" @click="login" :loading="isBtnLoading">{{btnText}}</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
import {Input, Switch, Form, FormItem} from 'element-ui';

export default {
    components: {
        ElInput: Input,
        ElSwitch: Switch,
        ElForm: Form,
        ElFormItem: FormItem,
    },
    props: [],
    data() {
        return {
            form: {
                phone: '',
                password: '',
                remember: false,
                captcha_type: 'pic',
            },
            captcha: '',
            rules: {
                phone: [
                    {required: true, message: '请输入手机号', trigger: 'blur'},
                ],
                password: [
                    {required: true, message: '请输入密码', trigger: 'blur'},
                ],
            },
            isBtnLoading: false,
        };
    },
    computed: {
        btnText() {
            if (this.isBtnLoading) return '登录中...';
            return '登录';
        },
    },
    watch: {},
    methods: {
        login() {
            this.$refs.form.validate((valid) => {
                if (!valid) return;
                this.isBtnLoading = true;
                API.post('auth/login', this.form).then((res) => {
                    this.$store.commit('setMy', res);
                    this.$router.push('/');
                }).finally(() => this.isBtnLoading = false);
            });
        },
        // 获取生成验证码的图片链接
        createCaptchaUrl() {
            API.get('auth/captcha', {params: {type: this.form.captcha_type}}).then((res) => {
                this.captcha = res.captcha;
                console.log(this.captcha);
            });
            // this.captcha = '/captcha/default?t=' + Date.now();
        },
        // 随机产生验证码校验方式 图形校验 邮箱校验
        createCaptchaType() {
            let captcha = ['pic', 'email'];
            this.form.captcha_type = captcha[parseInt(Math.random() * 2)];
        },
    },
    mounted() {
        // this.createCaptchaType();
        this.createCaptchaUrl(this.form.captcha_type);
        console.log(this.form.captcha_type);
    },
};
</script>

<style lang="scss">
    .login-page {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #e1e2e2;
        .el-card{
            width: 100%;
            max-width: 400px;
        }
        .title {
            color: #20a0ff;
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            line-height: 2.2;
            font-family: sans-serif;
        }
        .center .el-button{
            width: 100%;
        }
        .el-input.captcha {
            width: 200px;
        }
    }
</style>
