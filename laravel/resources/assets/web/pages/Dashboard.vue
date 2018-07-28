<template>
    <div class="dashboard">
        <div style="margin-top: 10px;">
            <el-carousel :interval="4000" type="card" 
                height="250px" :autoplay="false">
                <el-carousel-item v-for="(item, index) in banner" :key="index">
                    <img :src="item.url" height="250px" v-if="item.type == 1">
                    <video :src="item.url" controls="controls" height="250px" 
                        v-if="item.type == 3"></video>
                </el-carousel-item>
            </el-carousel>
            <router-link to="/chat_list">
                <el-button type="text">聊天室列表</el-button>
            </router-link>
        </div>
    </div>
</template>

<script>
import {Button, Carousel, CarouselItem} from 'element-ui';

export default {
    components: {
        ElButton: Button,
        ElCarousel: Carousel,
        ElCarouselItem: CarouselItem,
    },
    data() {
        return {
            banner: [],
            author: [],
        };
    },
    created() {
        this.fetchData();
    },
    mounted() {
    },
    methods: {
        fetchData() {
            API.get('home').then((r) => {
                this.banner = r.banner;
                this.author = r.author;
            })
        },
    },
};
</script>

<style lang="scss">
    .dashboard {
        width: 70%;
        margin: 0 auto;
    }
    .el-carousel__item img {
        margin: 0;
        width: 100%;
    }
    .el-carousel__item video {
        margin: 0;
        width: 100%;
    }
  
  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }
  
  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
</style>
