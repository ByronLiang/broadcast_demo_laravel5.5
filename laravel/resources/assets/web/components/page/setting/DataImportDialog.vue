<template>
    <el-dialog
        width="30%"
        title="资料导入"
        class="data-import__dialog gaoqi-dialog__reset"
        :visible.sync="dialogVisible"
        :before-close="handleClose" center>
        <section class="px-4 py-8 border-grey">
            <file-upload v-model="form.file" class="w-full">
                <div class="flex justify-between items-center" :style="{height: '3.6rem', lineHeight: '3.6rem'}">
                    <span class="flex-no-shrink">导入文件：</span>
                    <div class="border-grey mr-4 px-4 w-full">{{ form.file || '请选择.pdf,.xsl,.word格式的文件' }}</div>
                    <span class="flex-no-shrink border-shine-blue btn-shine-blue">上传文件</span>
                </div>
            </file-upload>

            <el-radio-group v-model="form.type" class="mt-8 flex justify-between items-center">
                <el-radio
                    :label="item"
                    v-for="item in types"
                    :key="'type-' + item"
                    class="w-1/3 mb-6">
                    {{ item }}
                </el-radio>
            </el-radio-group>

            <div class="text-center mt-8">
                <span class="border-shine-blue btn-shine-blue btn-import">导入</span>
                <span class="border-grey btn-default btn-import ml-4">下载模板</span>
            </div>
        </section>
    </el-dialog>
</template>

<script>
import {Dialog, Radio, RadioGroup} from 'element-ui';
import FileUpload from '../../base/FileUpload.vue';

export default {
    components: {
        ElDialog: Dialog,
        ElRadio: Radio,
        ElRadioGroup: RadioGroup,

        FileUpload,
    },
    data() {
        return {
            dialogVisible: false,
            form: {
                file: '',
                type: 'Material',
            },
            types: ['原材料资料', '固定资产资料', '人员资料', '能源资料', '无形资产资料'],
        };
    },
    methods: {
        open() {
            this.dialogVisible = true;
        },
        close() {
            this.dialogVisible = false;
        },
        handleClose() {
            this.close();
        },
        submit() {
            /**
            @param string type ⤵️
                ProductInvoice // 产品发票
                Material // 原料
                Energy // 能源
                FixedAsset // 固定资产
                IntangibleAsset // 无形资产
                Employee // 人员资料
                EmployeeWage // 人员工资
                Voucher // 凭证录入
             */
            API.post('supplier/import', this.form);
        },
    },
};
</script>

<style lang="scss">
    .data-import__dialog {
        .el-dialog {
            min-width: 54.7rem;
        }

        .el-radio {
            &+.el-radio {
                margin-left: 0;
            }
        }

        .btn-import {
            width: 12rem;
        }
    }
</style>
