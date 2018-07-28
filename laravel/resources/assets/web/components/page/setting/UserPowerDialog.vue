<template>
    <el-dialog
        width="60%"
        title="用户管理与权限设置"
        class="user-power__dialog gaoqi-dialog__reset"
        :visible.sync="dialogVisible"
        :before-close="handleClose" center>
        <section>
            <!-- 梯形标签 tab -->
            <div class="gaoqi-tab-trapezoidal__wrapper">
                <span
                    v-for="(item, index) in tabs"
                    :key="'tab: ' + item"
                    :class="{active: tabIndex == index}" @click="tabIndex = index">
                    {{ item }}
                </span>
            </div>

            <section class="border-grey">
                <!-- control bar -->
                <div class="gaoqi-control-bar__wrapper flex justify-between">
                    <div class="flex items-center">
                        <span>角色名：</span>
                        <input type="text" v-model="form.name" class="py-4">
                    </div>

                    <div>
                        <span class="btn-orange border-orange">新建</span>
                        <span class="btn-light-blue border-light-blue">编辑</span>
                        <span class="btn-light-green border-light-green">保存</span>
                        <span class="btn-shine-blue border-shine-blue">停用</span>
                    </div>
                </div>

                <!-- form -->
                <el-form
                    :model="form"
                    label-width="110px"
                    label-position="left"
                    v-if="tabIndex == 0"
                    class="gaoqi-base-form__wrapper px-4 py-4">
                    <div class="form-wrapper w-full border-grey">
                        <header class="mb-6">研发项目管理</header>

                        <div class="flex justify-between flex-wrap mx-6">
                            <el-form-item label="项目查看">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="立项申请">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="立项评审">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="研发活动">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="技术会议">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="项目总结">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                        </div>
                    </div>

                    <div class="form-wrapper w-full border-grey mt-4">
                        <header class="mb-6">研发费用管理</header>

                        <div class="flex justify-between flex-wrap mx-6">
                            <el-form-item label="费用查看">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="人员人工">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="原料费用">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="直接投入">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="资产折旧">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="设计费用">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="装备调试费">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="无形资产">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="其他费用">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="境内外部费用">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="境内外部费用">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                        </div>
                    </div>

                    <div class="form-wrapper w-full border-grey mt-4">
                        <header class="mb-6">其他费用</header>

                        <div class="flex justify-between flex-wrap mx-6">
                            <el-form-item label="样品管理">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="高新产品">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="收入统计">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="知识产权">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="研发中心">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="产学研合作">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="制度建设">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="政府科技立项">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="企业取得荣誉">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item>
                            </el-form-item>
                            <el-form-item label="基础资本管理">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="附件">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="角色管理">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                            <el-form-item label="操作员管理">
                                <el-input v-model="form.name"></el-input>
                            </el-form-item>
                        </div>
                    </div>
                </el-form>

                <el-form
                    v-else
                    :model="form"
                    label-width="80px"
                    label-position="top"
                    class="gaoqi-base-form__wrapper gaoqi-base-form__disabled flex justify-between flex-wrap px-8 pt-8">

                    <el-form-item label="用户名" required style="width: 30%">
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="角色" required style="width: 30%">
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="真是姓名" required style="width: 30%">
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="密码" required>
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="重输密码" required>
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="电话" required style="width: 30%">
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="手机" required style="width: 30%">
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="邮箱" required style="width: 30%">
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="请输入">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="地址" style="width: 100%" required>
                        <el-input
                            v-model="form.name"
                            :disabled="!isEdit"
                            placeholder="输入组织实施方式， 限400字以内。">
                        </el-input>
                    </el-form-item>
                </el-form>
            </section>

            <!-- table -->
            <section class="border-grey gaoqi-table__wrapper mt-6">
                <template v-if="tabIndex">
                    <el-table
                        :data="tableData"
                        border stripe
                        style="width: 100%"
                        key='operatorTable'>
                        <el-table-column label="序号" prop="id" align="center"></el-table-column>
                        <el-table-column label="用户名" prop="name" align="center"></el-table-column>
                        <el-table-column label="真是姓名" prop="name" align="center"></el-table-column>
                        <el-table-column label="电话" prop="name" align="center"></el-table-column>
                        <el-table-column label="手机" prop="name" align="center"></el-table-column>
                        <el-table-column label="邮箱" prop="name" align="center"></el-table-column>
                        <el-table-column label="地址" prop="name" align="center"></el-table-column>
                    </el-table>
                </template>

                <template v-else>
                    <el-table
                        :data="tableData"
                        border stripe
                        style="width: 100%"
                        key='characterTable'>
                        <el-table-column label="序号" prop="id" align="center"></el-table-column>
                        <el-table-column label="角色名" prop="name" align="center"></el-table-column>
                        <el-table-column label="单选" align="center">
                            <template slot-scope="{row, $index}">
                                <el-radio v-model="row.radio" :label="$index + 1">&nbsp;</el-radio>
                            </template>
                        </el-table-column>
                    </el-table>
                </template>
            </section>
        </section>
    </el-dialog>
</template>

<script>
import {Dialog, Form, FormItem, Input, Table, TableColumn, Radio} from 'element-ui';

export default {
    components: {
        ElDialog: Dialog,
        ElForm: Form,
        ElFormItem: FormItem,
        ElInput: Input,
        ElTable: Table,
        ElTableColumn: TableColumn,
        ElRadio: Radio,
    },
    data() {
        return {
            isEdit: true,
            tabIndex: 1,
            dialogVisible: false,
            tabs: ['角色', '操作员'],
            form: {
                name: '',
                type: '',
            },
            tableData: [
                {
                    id: '001',
                    name: '贺哈哈',
                    radio: true,
                },
            ],
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
    },
};
</script>

<style lang="scss">
    .user-power__dialog {
        .gaoqi-tab-trapezoidal__wrapper {
            margin: 0;
        }

        .form-wrapper {
            > header {
                width: 100%;
                height: 4.4rem;
                line-height: 4.4rem;
                background: #F0F4F9;
                text-align: center;
                padding: 0 1rem;
            }
        }

        .gaoqi-table__wrapper {
            .el-radio__label {
                font-size: 0;
                padding: 0;
            }
        }
    }
</style>
