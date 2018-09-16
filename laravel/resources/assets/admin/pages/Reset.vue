<template>
    <div class="login-page">
        <el-card>
            <div slot="header" class="text-center text-xl">{{ $store.state.site_title }}-重置密码</div>
            <el-form :model="form" :rules="rules" ref="form" label-position="top" @keyup.enter.native="login">
                <el-form-item prop="phone">
                    <el-input placeholder="手机号" v-model="form.phone"></el-input>
                </el-form-item>
                <el-form-item prop="captcha">
                    <div class="captcha">
                        <el-input placeholder="验证码" v-model="form.captcha" />
                    </div>
                    <el-button class="float-right" @click="getCaptcha">获取验证码</el-button>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" v-model.trim="form.password" placeholder="请输入密码">
                    </el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" v-model.trim="form.password_confirmation" placeholder="请再次输入密码">
                    </el-input>
                </el-form-item>
                <el-form-item class="center">
                    <el-button type="primary" @click="reset" :loading="isBtnLoading">{{btnText}}</el-button>
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
                captcha: '',
                password: '',
            },
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
            if (this.isBtnLoading) return '修改中...';
            return '提交';
        },
    },
    watch: {},
    methods: {
        reset() {
            this.$refs.form.validate((valid) => {
                if (!valid) return;
                this.isBtnLoading = true;
                API.post('auth/reset-passwd', this.form).then((res) => {
                    if (res) {
                        $ele.$message.success('修改成功~');
                        setTimeout(() => {
                            window.location = '/admin/login';
                        }, 100);
                    }
                }).finally(() => this.isBtnLoading = false);
            });
        },
        getCaptcha() {
            this.form.is_exist = true;
            API.post('supplier/captcha', this.form).then((res) => {
                $ele.$message.success('验证码已发送~');
            });
        },
    },
    mounted() {
    },
};
</script>
<style lang="scss">
    .login-page {
        .captcha {
            width: 70%;
            float: left;
        }
    }
</style>
