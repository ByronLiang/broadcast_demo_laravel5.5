<template>
    <el-dialog
        width="30%"
        :title="dialogTitle"
        class="day-password__dialog gaoqi-dialog__reset"
        :visible.sync="dialogVisible"
        :before-close="handleClose" center>
        <section>
            <el-form
                :model="form"
                :label-width="type === 'day' ? '90px' : '128px'"
                label-position="left"
                label-suffix=":">
                <template v-if="type === 'day'">
                    <el-form-item label="周工作天数">
                        <el-input v-model="form.time"></el-input>
                    </el-form-item>
                </template>

                <template v-else>
                    <el-form-item label="请输入原始密码">
                        <el-input v-model="form.password_old"></el-input>
                    </el-form-item>

                    <el-form-item label="请输入新密码">
                        <el-input v-model="form.password"></el-input>
                    </el-form-item>

                    <el-form-item label="请再次输入新密码">
                        <el-input v-model="form.password_confirmation"></el-input>
                    </el-form-item>
                </template>
            </el-form>

            <div class="flex justify-between" :style="{marginLeft: type === 'day' ? '90px' : '128px'}">
                <span class="border-shine-blue btn-shine-blue" @click="changePwd">确认</span>
                <span class="border-grey btn-default">取消</span>
            </div>
        </section>
    </el-dialog>
</template>

<script>
import {Dialog, Form, FormItem, Input} from 'element-ui';

export default {
    components: {
        ElDialog: Dialog,
        ElForm: Form,
        ElFormItem: FormItem,
        ElInput: Input,
    },
    data() {
        return {
            dialogVisible: false,
            form: {
                file: '',
                type: '',
            },
            type: 'day', // day: 系统设置 or password: 修改密码
        };
    },
    computed: {
        dialogTitle() {
            return this.type === 'day' ? '系统设置' : '修改密码';
        },
    },
    methods: {
        open(type = 'day') {
            if (type === 'password') this.type = type;

            this.dialogVisible = true;
        },
        close() {
            this.dialogVisible = false;
        },
        handleClose() {
            this.close();
        },
        /**
         * submit form
         * @param string password_old 旧密码
         * @param string password 新密码
         * @param string password_confirmation 新密码
         * @return array
         */
        changePwd() {
            API.post('change-pwd', this.form);
        },
    },
};
</script>

<style lang="scss">
    .day-password__dialog {
        .el-dialog {
            min-width: 50rem;
        }
    }
</style>
