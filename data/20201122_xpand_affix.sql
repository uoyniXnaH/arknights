--
-- operator affix
--

CREATE TABLE IF NOT EXISTS operator_affix (
  `codename` varchar(20) NOT NULL,
  `affix` varchar(20),
  INDEX `code` (`codename`),
  FOREIGN KEY (`codename`)
    REFERENCES recruitment_operator(`codename`)
    ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO operator_affix VALUES
("THRM-EX","爆发"),
("THRM-EX","支援机械"),
("陈","爆发"),
("陈","输出"),
("诗怀雅","输出"),
("诗怀雅","支援"),
("格雷伊","群攻"),
("格雷伊","减速"),
("泡普卡","群攻"),
("泡普卡","生存"),
("斑点","防护"),
("斑点","治疗"),
("斯卡蒂","输出"),
("斯卡蒂","生存"),
("夜魔","输出"),
("夜魔","治疗"),
("夜魔","减速"),
("月见夜","输出"),
("空爆","群攻"),
("银灰","输出"),
("银灰","支援"),
("塞雷娅","防护"),
("塞雷娅","治疗"),
("塞雷娅","支援"),
("星熊","防护"),
("星熊","输出"),
("夜莺","治疗"),
("夜莺","支援"),
("闪灵","治疗"),
("闪灵","支援"),
("伊芙利特","群攻"),
("伊芙利特","削弱"),
("推进之王","费用回复"),
("推进之王","输出"),
("能天使","输出"),
("食铁兽","位移"),
("食铁兽","减速"),
("狮蝎","输出"),
("狮蝎","生存"),
("崖心","位移"),
("崖心","输出"),
("守林人","输出"),
("守林人","爆发"),
("普罗旺斯","输出"),
("火神","生存"),
("火神","防护"),
("火神","输出"),
("可颂","防护"),
("可颂","位移"),
("雷蛇","防护"),
("雷蛇","输出"),
("红","快速复活"),
("红","控场"),
("临光","防护"),
("临光","治疗"),
("华法琳","治疗"),
("华法琳","支援"),
("赫默","治疗"),
("陨星","群攻"),
("陨星","削弱"),
("白金","输出"),
("蓝毒","输出"),
("幽灵鲨","群攻"),
("幽灵鲨","生存"),
("因陀罗","输出"),
("因陀罗","生存"),
("德克萨斯","费用回复"),
("德克萨斯","控场"),
("凛冬","费用回复"),
("凛冬","支援"),
("白面鸮","治疗"),
("白面鸮","支援"),
("阿消","位移"),
("古米","防护"),
("古米","治疗"),
("蛇屠箱","防护"),
("角峰","防护"),
("调香师","治疗"),
("末药","治疗"),
("暗索","位移"),
("砾","快速复活"),
("砾","防护"),
("慕斯","输出"),
("艾丝黛尔","群攻"),
("艾丝黛尔","生存"),
("霜叶","减速"),
("霜叶","输出"),
("缠丸","生存"),
("缠丸","输出"),
("杜宾","输出"),
("杜宾","支援"),
("红豆","输出"),
("红豆","费用回复"),
("清道夫","费用回复"),
("清道夫","输出"),
("白雪","群攻"),
("白雪","减速"),
("流星","输出"),
("流星","削弱"),
("杰西卡","输出"),
("杰西卡","生存"),
("远山","群攻"),
("夜烟","输出"),
("夜烟","削弱"),
("史都华德","输出"),
("安赛尔","治疗"),
("芙蓉","治疗"),
("炎熔","群攻"),
("安德切尔","输出"),
("克洛丝","输出"),
("米格鲁","防护"),
("玫兰莎","输出"),
("玫兰莎","生存"),
("翎羽","输出"),
("翎羽","费用回复"),
("香草","费用回复"),
("芬","费用回复"),
("12F",NULL),
("杜林",NULL),
("巡林者",NULL),
("黑角",NULL),
("夜刀",NULL),
("Castle-3","支援"),
("Castle-3","支援机械"),
("Lancet-2","治疗"),
("Lancet-2","支援机械"),
("真理","减速"),
("真理","输出"),
("初雪","削弱"),
("梅尔","召唤"),
("梅尔","控场"),
("地灵","减速"),
("梓兰","减速"),
("桃金娘","费用回复"),
("桃金娘","治疗"),
("苏苏洛","治疗"),
("星极","输出"),
("星极","防护"),
("格劳克斯","减速"),
("格劳克斯","控场"),
("赫拉格","输出"),
("赫拉格","生存"),
("黑","输出");