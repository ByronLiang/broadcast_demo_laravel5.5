<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('companies')->delete();

        \DB::table('companies')->insert(array (
            0 =>
            array (
                'id' => 1,
                'number' => 1,
                'name' => '中国工商银行股份有限公司牡丹江分行',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'number' => 2,
                'name' => '中国移动通信集团黑龙江有限公司牡丹江分公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'number' => 3,
                'name' => '中国联合网络通信有限公司牡丹江分公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'number' => 4,
                'name' => '中国电信股份有限公司牡丹江分公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'number' => 5,
                'name' => '中国移动通信集团黑龙江有限公司穆棱分公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'number' => 6,
                'name' => '中国人民人寿保险股份有限公司牡丹江市中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'number' => 7,
                'name' => '中国人民财产保险股份有限公司牡丹江市分公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'number' => 8,
                'name' => '中国平安人寿保险股份有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'number' => 9,
                'name' => '中国平安财产保险股份有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'number' => 10,
                'name' => '中国太平洋财产保险股份有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'number' => 11,
                'name' => '中国太平洋人寿保险股份有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'number' => 12,
                'name' => '中国人寿财产保险股份有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'number' => 13,
                'name' => '中国人寿保险股份有限公司牡丹江分公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'number' => 14,
                'name' => '阳光农业相互保险公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'number' => 15,
                'name' => '新华人寿保险股份有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'number' => 16,
                'name' => '太平人寿保险有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'number' => 17,
                'name' => '华安财产保险股份有限公司牡丹江中心支公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'number' => 18,
                'name' => '大商股份牡丹江百货大楼有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'number' => 19,
                'name' => '大商股份牡丹江新玛特购物广场有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'number' => 20,
                'name' => '百威英博（牡丹江）啤酒有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'number' => 21,
                'name' => '黑龙江黑宝药业股份有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'number' => 22,
                'name' => '黑龙江红星集团食品有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 =>
            array (
                'id' => 23,
                'number' => 23,
                'name' => '黑龙江林海华安新材料股份有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 =>
            array (
                'id' => 24,
                'number' => 24,
                'name' => '牡丹江友博药业有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 =>
            array (
                'id' => 25,
                'number' => 25,
                'name' => '牡丹江天利医药连锁有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 =>
            array (
                'id' => 26,
                'number' => 26,
                'name' => '黑龙江仁合堂药业有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 =>
            array (
                'id' => 27,
                'number' => 27,
                'name' => '牡丹江苏宁云商销售有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 =>
            array (
                'id' => 28,
                'number' => 28,
                'name' => '黑龙江萨哈林食品有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 =>
            array (
                'id' => 29,
                'number' => 29,
                'name' => '黑龙江万瑞物业管理有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 =>
            array (
                'id' => 30,
                'number' => 30,
                'name' => '黑龙江小慈生态农业发展有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 =>
            array (
                'id' => 31,
                'number' => 31,
                'name' => '黑龙江农嘉力肥业有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 =>
            array (
                'id' => 32,
                'number' => 32,
                'name' => '黑龙江省德顺有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 =>
            array (
                'id' => 33,
                'number' => 33,
                'name' => '牡丹江中信恒祺汽车销售服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 =>
            array (
                'id' => 34,
                'number' => 34,
                'name' => '牡丹江通达汽车销售服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 =>
            array (
                'id' => 35,
                'number' => 35,
                'name' => '牡丹江绿地申通汽车销售服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 =>
            array (
                'id' => 36,
                'number' => 36,
                'name' => '牡丹江天拓汽车销售服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 =>
            array (
                'id' => 37,
                'number' => 37,
                'name' => '牡丹江市万里路汽车销售服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 =>
            array (
                'id' => 38,
                'number' => 38,
                'name' => '牡丹江松城调味品有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 =>
            array (
                'id' => 39,
                'number' => 39,
                'name' => '牡丹江市特华得食品有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 =>
            array (
                'id' => 40,
                'number' => 40,
                'name' => '牡丹江市夏威夷国际大酒店有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 =>
            array (
                'id' => 41,
                'number' => 41,
                'name' => '牡丹江商业储运有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 =>
            array (
                'id' => 42,
                'number' => 42,
                'name' => '牡丹江民用建筑勘察设计院有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 =>
            array (
                'id' => 43,
                'number' => 43,
                'name' => '牡丹江星元房产有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 =>
            array (
                'id' => 44,
                'number' => 44,
                'name' => '牡丹江星元建筑有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 =>
            array (
                'id' => 45,
                'number' => 45,
                'name' => '牡丹江中国国际旅行社有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 =>
            array (
                'id' => 46,
                'number' => 46,
                'name' => '牡丹江招商国际旅行社有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 =>
            array (
                'id' => 47,
                'number' => 47,
                'name' => '牡丹江市全城热恋珠宝首饰商场有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 =>
            array (
                'id' => 48,
                'number' => 48,
                'name' => '牡丹江市新新娘婚纱摄影有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 =>
            array (
                'id' => 49,
                'number' => 49,
                'name' => '牡丹江新闻传媒集团会展有限公司 ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 =>
            array (
                'id' => 50,
                'number' => 50,
                'name' => '牡丹江龙头泉实业有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 =>
            array (
                'id' => 51,
                'number' => 51,
                'name' => '牡丹江市秀梅洗衣设备有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 =>
            array (
                'id' => 52,
                'number' => 52,
                'name' => '牡丹江三联锁具有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 =>
            array (
                'id' => 53,
                'number' => 53,
                'name' => '牡丹江海江顺科技有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 =>
            array (
                'id' => 54,
                'number' => 54,
                'name' => '牡丹江泉来商贸有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 =>
            array (
                'id' => 55,
                'number' => 55,
                'name' => '牡丹江金蚂蚁生物工程实业有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 =>
            array (
                'id' => 56,
                'number' => 56,
                'name' => '牡丹江鼎弘冷库仓储服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 =>
            array (
                'id' => 57,
                'number' => 57,
                'name' => '牡丹江爱民区丰收村军创农产品专业合作社',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 =>
            array (
                'id' => 58,
                'number' => 58,
                'name' => '牡丹江市东安市场有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 =>
            array (
                'id' => 59,
                'number' => 59,
                'name' => '牡丹江市旅游发展有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 =>
            array (
                'id' => 60,
                'number' => 60,
                'name' => '牡丹江市桐沣食品有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 =>
            array (
                'id' => 61,
                'number' => 61,
                'name' => '牡丹江市回回顺清真食品有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 =>
            array (
                'id' => 62,
                'number' => 62,
                'name' => '牡丹江灵泰药业股份有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 =>
            array (
                'id' => 63,
                'number' => 63,
                'name' => '牡丹江天擎科技有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 =>
            array (
                'id' => 64,
                'number' => 64,
                'name' => '牡丹江西安区百世体安医疗美容医院',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 =>
            array (
                'id' => 65,
                'number' => 65,
                'name' => '牡丹江市晨光眼科门诊',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 =>
            array (
                'id' => 66,
                'number' => 66,
                'name' => '牡丹江市东安区美加摄影部',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 =>
            array (
                'id' => 67,
                'number' => 67,
                'name' => '宁安市渤海镇镜泊人家',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 =>
            array (
                'id' => 68,
                'number' => 68,
                'name' => '牡丹江市东安区洁希亚洗衣店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 =>
            array (
                'id' => 69,
                'number' => 69,
                'name' => '牡丹江市东安区粟氏天府烧烤七星街店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 =>
            array (
                'id' => 70,
                'number' => 70,
                'name' => '牡丹江市东安区粟氏天府烧烤新安街分店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 =>
            array (
                'id' => 71,
                'number' => 71,
                'name' => '牡丹江市西安区粟氏天府烧烤串店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 =>
            array (
                'id' => 72,
                'number' => 72,
                'name' => '牡丹江市东安区粟氏天府烧烤新华店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 =>
            array (
                'id' => 73,
                'number' => 73,
                'name' => '牡丹江市西安区金世元皮草广场',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 =>
            array (
                'id' => 74,
                'number' => 74,
                'name' => '牡丹江市金世元服饰',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 =>
            array (
                'id' => 75,
                'number' => 75,
                'name' => '牡丹江市西安区欧派橱柜衣柜专卖店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 =>
            array (
                'id' => 76,
                'number' => 76,
                'name' => '牡丹江市西安区六桂福珠宝店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 =>
            array (
                'id' => 77,
                'number' => 77,
                'name' => '牡丹江市欧品艺术蛋糕厂',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 =>
            array (
                'id' => 78,
                'number' => 78,
                'name' => '牡丹江市西安区参源俄货店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 =>
            array (
                'id' => 79,
                'number' => 79,
                'name' => '牡丹江市东安区爱眼眼镜',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 =>
            array (
                'id' => 80,
                'number' => 80,
                'name' => '牡丹江市西安区利民开锁店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 =>
            array (
                'id' => 81,
                'number' => 81,
                'name' => '牡丹江西安区瑞诚百货商店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 =>
            array (
                'id' => 82,
                'number' => 82,
                'name' => '牡丹江市爱民区钜锋机械加工厂',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 =>
            array (
                'id' => 83,
                'number' => 83,
                'name' => '牡丹江市世纪塑料彩印厂',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 =>
            array (
                'id' => 84,
                'number' => 84,
                'name' => '牡丹江市德乔教育培训机构',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 =>
            array (
                'id' => 85,
                'number' => 85,
                'name' => '林口盛德车业研发制造有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 =>
            array (
                'id' => 86,
                'number' => 86,
                'name' => '牡丹江市北方远东水泥厂',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 =>
            array (
                'id' => 87,
                'number' => 87,
                'name' => '穆棱市八面通镇家乐购超市',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 =>
            array (
                'id' => 88,
                'number' => 88,
                'name' => '东宁司机乐汽配工贸有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 =>
            array (
                'id' => 89,
                'number' => 89,
                'name' => '东宁市天施恩现代农业发展有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 =>
            array (
                'id' => 90,
                'number' => 90,
                'name' => '东宁市英奈尔山产品有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 =>
            array (
                'id' => 91,
                'number' => 91,
                'name' => '东宁市五星大米加工厂',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 =>
            array (
                'id' => 92,
                'number' => 92,
                'name' => '宁安市东京城镇植忠常压锅炉厂',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 =>
            array (
                'id' => 93,
                'number' => 93,
                'name' => '牡丹江市讯通通讯器材有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 =>
            array (
                'id' => 94,
                'number' => 94,
                'name' => '牡丹江中辰石油有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 =>
            array (
                'id' => 95,
                'number' => 95,
                'name' => '黑龙江盛世雪城科技有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 =>
            array (
                'id' => 96,
                'number' => 96,
                'name' => ' 牡丹江市西安区易视康眼镜店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 =>
            array (
                'id' => 97,
                'number' => 97,
                'name' => ' 牡丹江红日房地产开发有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 =>
            array (
                'id' => 98,
                'number' => 98,
                'name' => '牡丹江市东安区小豆丁婴童食品店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 =>
            array (
                'id' => 99,
                'number' => 99,
                'name' => ' 牡丹江铭溢空调销售有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 =>
            array (
                'id' => 100,
                'number' => 100,
                'name' => '牡丹江佰佳汽车销售服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 =>
            array (
                'id' => 101,
                'number' => 101,
                'name' => '东宁县天翼果菜深加工有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 =>
            array (
                'id' => 102,
                'number' => 102,
                'name' => '牡丹江市城郊农村信用合作联社',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 =>
            array (
                'id' => 103,
                'number' => 103,
                'name' => '牡丹江市万佳物业管理有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 =>
            array (
                'id' => 104,
                'number' => 104,
                'name' => '牡丹江中信恒业汽车销售服务有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 =>
            array (
                'id' => 105,
                'number' => 105,
                'name' => '牡丹江市盛世桦炜通讯有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 =>
            array (
                'id' => 106,
                'number' => 106,
                'name' => '牡丹江市东安区六福皮草城',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 =>
            array (
                'id' => 107,
                'number' => 107,
                'name' => '牡丹江市东安区龙鼎喜满堂酒店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 =>
            array (
                'id' => 108,
                'number' => 108,
                'name' => '牡丹江市西安区太平路喜家德水饺店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 =>
            array (
                'id' => 109,
                'number' => 109,
                'name' => '牡丹江九鲜坊餐饮管理有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 =>
            array (
                'id' => 110,
                'number' => 110,
                'name' => '牡丹江市西安区金海民族大药房',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 =>
            array (
                'id' => 111,
                'number' => 111,
                'name' => '牡丹江市东安区泽民大药房',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 =>
            array (
                'id' => 112,
                'number' => 112,
                'name' => '牡丹江市西安区金源装饰材料商店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 =>
            array (
                'id' => 113,
                'number' => 113,
                'name' => '牡丹江市西安区鑫宏泰装饰材料商店',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 =>
            array (
                'id' => 114,
                'number' => 114,
                'name' => '牡丹江鸿克服饰有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 =>
            array (
                'id' => 115,
                'number' => 115,
                'name' => '东宁亿拓贸易有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 =>
            array (
                'id' => 116,
                'number' => 116,
                'name' => '黑龙江宁古风仪服饰制造有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 =>
            array (
                'id' => 117,
                'number' => 117,
                'name' => '牡丹江市东安区星宇东北山货批发部',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 =>
            array (
                'id' => 118,
                'number' => 118,
                'name' => '牡丹江市丰合堂大药房有限责任公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 =>
            array (
                'id' => 119,
                'number' => 119,
                'name' => '黑龙江鑫盛万隆电子科技有限公司',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
