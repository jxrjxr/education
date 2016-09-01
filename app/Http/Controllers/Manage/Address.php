<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Input;

use DB;
use App\Models\Address as AddressM;

class Address extends Controller
{
    public function lists()
    {
        $province = AddressM::get(['id','province','city']);
        return response()->json(['success'=>'Y','msg'=>'', 'data'=>$province]);
    }

    public function inssert()
    {
        $string = '河北省： 石家庄 保定市 秦皇岛 唐山市 邯郸市 邢台市 沧州市 承德市 廊坊市 衡水市 张家口 
山西省： 太原市 大同市 阳泉市 长治市 临汾市 晋中市 运城市 晋城市 忻州市 朔州市 吕梁市 
北京： 东城区 西城区 海淀区 丰台区 朝阳区 石景山区 通州区 顺义区 房山区 大兴区 昌平区 怀柔区 平谷区 门头沟区 密云县 延庆县
上海： 黄浦区 静安区 徐汇区 长宁区 杨浦区 虹口区 普陀区 浦东新区 宝山区 嘉定区 闵行区 松江区 青浦区 奉贤区 金山区
重庆： 渝中区 大渡口区 江北区 沙坪坝区 九龙坡区 南岸区 北碚区 万盛区 双桥区 渝北区 巴南区万州区 涪陵区 黔江区 长寿区 江津区 合川区 永川区 南川区 綦江县 潼南县 铜梁县 大足县 荣昌县 璧山县 垫江县 武隆县 丰都县 城口县 梁平县 开县 巫溪县 巫山县 奉节县 云阳县 忠县 石柱土家族自治县 彭水苗族土家族自治县 酉阳土家族苗族自治县 秀山土家族苗
青岛： 市南区 市北区 四方区 李沧区
天津： 和平区 河西区 河北区 河东区 南开区 红桥区 东丽区 西青区 津南区 北辰区
内蒙古： 呼和浩特 呼伦贝尔 包头市 赤峰市 乌海市 通辽市 鄂尔多斯 乌兰察布 巴彦淖尔 
辽宁省： 盘锦市 鞍山市 抚顺市 本溪市 铁岭市 锦州市 丹东市 辽阳市 葫芦岛 阜新市 朝阳市 营口市 
吉林省： 吉林市 通化市 白城市 四平市 辽源市 松原市 白山市 
黑龙江省： 伊春市 牡丹江 大庆市 鸡西市 鹤岗市 绥化市 双鸭山 七台河 佳木斯 黑河市 齐齐哈尔市 
江苏省： 无锡市 常州市 扬州市 徐州市 苏州市 连云港 盐城市 淮安市 宿迁市 镇江市 南通市 泰州市 
浙江省： 绍兴市 温州市 湖州市 嘉兴市 台州市 金华市 舟山市 衢州市 丽水市 安徽省 
合肥市： 芜湖市 亳州市 马鞍山 池州市 淮南市 淮北市 蚌埠市 巢湖市 安庆市 宿州市 宣城市 滁州市 黄山市 六安市 阜阳市 铜陵市 
福建省： 福州市 泉州市 漳州市 南平市 三明市 龙岩市 莆田市 宁德市 
江西省： 南昌市 赣州市 景德镇 九江市 萍乡市 新余市 抚州市 宜春市 上饶市 鹰潭市 吉安市 
山东省： 潍坊市 淄博市 威海市 枣庄市 泰安市 临沂市 东营市 济宁市 烟台市 菏泽市 日照市 德州市 聊城市 滨州市 莱芜市 
河南省： 郑州市 洛阳市 焦作市 商丘市 信阳市 新乡市 安阳市 开封市 漯河市 南阳市 鹤壁市 平顶山 濮阳市 许昌市 周口市 三门峡 驻马店 
湖北省： 荆门市 咸宁市 襄樊市 荆州市 黄石市 宜昌市 随州市 鄂州市 孝感市 黄冈市 十堰市 
湖南省： 长沙市 郴州市 娄底市 衡阳市 株洲市 湘潭市 岳阳市 常德市 邵阳市 益阳市 永州市 张家界 怀化市 
广东省： 江门市 佛山市 汕头市 湛江市 韶关市 中山市 珠海市 茂名市 肇庆市 阳江市 惠州市 潮州市 揭阳市 清远市 河源市 东莞市 汕尾市 云浮市 
广西省： 南宁市 贺州市 柳州市 桂林市 梧州市 北海市 玉林市 钦州市 百色市 防城港 贵港市 河池市 崇左市 来宾市 
海南省： 海口市 三亚市 
四川省： 乐山市 雅安市 广安市 南充市 自贡市 泸州市 内江市 宜宾市 广元市 达州市 资阳市 绵阳市 眉山市 巴中市 攀枝花 遂宁市 德阳市 
贵州省： 贵阳市 安顺市 遵义市 六盘水 
云南省： 昆明市 玉溪市 大理市 曲靖市 昭通市 保山市 丽江市 临沧市 
西藏： 拉萨市 阿里 
陕西省： 咸阳市 榆林市 宝鸡市 铜川市 渭南市 汉中市 安康市 商洛市 延安市 
甘肃省： 兰州市 白银市 武威市 金昌市 平凉市 张掖市 嘉峪关 酒泉市 庆阳市 定西市 陇南市 天水市 
青海省： 西宁市 
宁夏： 银川市 固原市 青铜峡市 石嘴山市 中卫市 
新疆： 乌鲁木齐 克拉玛依市 
香港特别行政区： 香港岛 九龙 新界 新界西
澳门特别行政区： 澳门半岛 澳门离岛
台湾： 基隆市 台中市 新竹市 台南市 嘉义市 高雄市';

        $arr1 =  explode("\n",$string);

        foreach ($arr1 as $key => $value) {
            $insertData = [];
            $arr2 = explode("： ",$value);
            $arr3 = explode(" ",$arr2[1]);
            array_pop($arr3);
            foreach($arr3 as $k=>$v){
                $insertData[] = ['province'=>$arr2[0],'city'=>$v];
            }
            AddressM::insert($insertData);
        }
    }


}