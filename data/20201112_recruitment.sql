CREATE TABLE IF NOT EXISTS recruitment_operator (
  codename varchar(20) NOT NULL UNIQUE,
  qualification varchar(20),
  position varchar(10),
  class varchar(10),
  affix1 varchar(20),
  affix2 varchar(20),
  affix3 varchar(20),
  affix4 varchar(20),
  affix5 varchar(20),
  affix6 varchar(20),
  rarity int
);

INSERT INTO recruitment_operator (`codename`,`qualification`,`position`,`class`,`affix1`,`affix2`,`affix3`,`rarity`)
VALUES
("THRM-EX",NULL,"近战位","特种","爆发","支援机械",NULL,"1"),
("陈","高级资深干员","近战位","近卫","爆发","输出",NULL,"6"),
("诗怀雅","资深干员","近战位","近卫","输出","支援",NULL,"5"),
("格雷伊",NULL,"远程位","术师","群攻","减速",NULL,"4"),
("泡普卡",NULL,"近战位","近卫","群攻","生存",NULL,"3"),
("斑点",NULL,"近战位","重装","防护","治疗",NULL,"3"),
("斯卡蒂","高级资深干员","近战位","近卫","输出","生存",NULL,"6"),
("夜魔","资深干员","远程位","术师","输出","治疗","减速","5"),
("月见夜",NULL,"近战位","近卫","输出",NULL,NULL,"3"),
("空爆",NULL,"远程位","狙击","群攻",NULL,NULL,"3"),
("银灰","高级资深干员","近战位","近卫","输出","支援",NULL,"6"),
("塞雷娅","高级资深干员","近战位","重装","防护","治疗","支援","6"),
("星熊","高级资深干员","近战位","重装","防护","输出",NULL,"6"),
("夜莺","高级资深干员","远程位","医疗","治疗","支援",NULL,"6"),
("闪灵","高级资深干员","远程位","医疗","治疗","支援",NULL,"6"),
("伊芙利特","高级资深干员","远程位","术师","群攻","削弱",NULL,"6"),
("推进之王","高级资深干员","近战位","先锋","费用回复","输出",NULL,"6"),
("能天使","高级资深干员","远程位","狙击","输出",NULL,NULL,"6"),
("食铁兽","资深干员","近战位","特种","位移","减速",NULL,"5"),
("狮蝎","资深干员","近战位","特种","输出","生存",NULL,"5"),
("崖心","资深干员","近战位","特种","位移","输出",NULL,"5"),
("守林人","资深干员","远程位","狙击","输出","爆发",NULL,"5"),
("普罗旺斯","资深干员","远程位","狙击","输出",NULL,NULL,"5"),
("火神","资深干员","近战位","重装","生存","防护","输出","5"),
("可颂","资深干员","近战位","重装","防护","位移",NULL,"5"),
("雷蛇","资深干员","近战位","重装","防护","输出",NULL,"5"),
("红","资深干员","近战位","特种","快速复活","控场",NULL,"5"),
("临光","资深干员","近战位","重装","防护","治疗",NULL,"5"),
("华法琳","资深干员","远程位","医疗","治疗","支援",NULL,"5"),
("赫默","资深干员","远程位","医疗","治疗",NULL,NULL,"5"),
("陨星","资深干员","远程位","狙击","群攻","削弱",NULL,"5"),
("白金","资深干员","远程位","狙击","输出",NULL,NULL,"5"),
("蓝毒","资深干员","远程位","狙击","输出",NULL,NULL,"5"),
("幽灵鲨","资深干员","近战位","近卫","群攻","生存",NULL,"5"),
("因陀罗","资深干员","近战位","近卫","输出","生存",NULL,"5"),
("德克萨斯","资深干员","近战位","先锋","费用回复","控场",NULL,"5"),
("凛冬","资深干员","近战位","先锋","费用回复","支援",NULL,"5"),
("白面鸮","资深干员","远程位","医疗","治疗","支援",NULL,"5"),
("阿消",NULL,"近战位","特种","位移",NULL,NULL,"4"),
("古米",NULL,"近战位","重装","防护","治疗",NULL,"4"),
("蛇屠箱",NULL,"近战位","重装","防护",NULL,NULL,"4"),
("角峰",NULL,"近战位","重装","防护",NULL,NULL,"4"),
("调香师",NULL,"远程位","医疗","治疗",NULL,NULL,"4"),
("末药",NULL,"远程位","医疗","治疗",NULL,NULL,"4"),
("暗索",NULL,"近战位","特种","位移",NULL,NULL,"4"),
("砾",NULL,"近战位","特种","快速复活","防护",NULL,"4"),
("慕斯",NULL,"近战位","近卫","输出",NULL,NULL,"4"),
("艾丝黛尔",NULL,"近战位","近卫","群攻","生存",NULL,"4"),
("霜叶",NULL,"近战位","近卫","减速","输出",NULL,"4"),
("缠丸",NULL,"近战位","近卫","生存","输出",NULL,"4"),
("杜宾",NULL,"近战位","近卫","输出","支援",NULL,"4"),
("红豆",NULL,"近战位","先锋","输出","费用回复",NULL,"4"),
("清道夫",NULL,"近战位","先锋","费用回复","输出",NULL,"4"),
("白雪",NULL,"远程位","狙击","群攻","减速",NULL,"4"),
("流星",NULL,"远程位","狙击","输出","削弱",NULL,"4"),
("杰西卡",NULL,"远程位","狙击","输出","生存",NULL,"4"),
("远山",NULL,"远程位","术师","群攻",NULL,NULL,"4"),
("夜烟",NULL,"远程位","术师","输出","削弱",NULL,"4"),
("史都华德",NULL,"远程位","术师","输出",NULL,NULL,"3"),
("安赛尔",NULL,"远程位","医疗","治疗",NULL,NULL,"3"),
("芙蓉",NULL,"远程位","医疗","治疗",NULL,NULL,"3"),
("炎熔",NULL,"远程位","术师","群攻",NULL,NULL,"3"),
("安德切尔",NULL,"远程位","狙击","输出",NULL,NULL,"3"),
("克洛丝",NULL,"远程位","狙击","输出",NULL,NULL,"3"),
("米格鲁",NULL,"近战位","重装","防护",NULL,NULL,"3"),
("玫兰莎",NULL,"近战位","近卫","输出","生存",NULL,"3"),
("翎羽",NULL,"近战位","先锋","输出","费用回复",NULL,"3"),
("香草",NULL,"近战位","先锋","费用回复",NULL,NULL,"3"),
("芬",NULL,"近战位","先锋","费用回复",NULL,NULL,"3"),
("12F","新手","远程位","术师",NULL,NULL,NULL,"2"),
("杜林","新手","远程位","术师",NULL,NULL,NULL,"2"),
("巡林者","新手","远程位","狙击",NULL,NULL,NULL,"2"),
("黑角","新手","近战位","重装",NULL,NULL,NULL,"2"),
("夜刀","新手","近战位","先锋",NULL,NULL,NULL,"2"),
("Castle-3",NULL,"近战位","近卫","支援","支援机械",NULL,"1"),
("Lancet-2",NULL,"远程位","医疗","治疗","支援机械",NULL,"1"),
("真理","资深干员","远程位","辅助","减速","输出",NULL,"5"),
("初雪","资深干员","远程位","辅助","削弱",NULL,NULL,"5"),
("梅尔","资深干员","远程位","辅助","召唤","控场",NULL,"5"),
("地灵",NULL,"远程位","辅助","减速",NULL,NULL,"4"),
("梓兰",NULL,"远程位","辅助","减速",NULL,NULL,"3"),
("桃金娘",NULL,"近战位","先锋","费用回复","治疗",NULL,"4"),
("苏苏洛",NULL,"远程位","医疗","治疗",NULL,NULL,"4"),
("星极","资深干员","近战位","近卫","输出","防护",NULL,"5"),
("格劳克斯","资深干员","远程位","辅助","减速","控场",NULL,"5"),
("赫拉格","高级资深干员","近战位","近卫","输出","生存",NULL,"6"),
("黑","高级资深干员","远程位","狙击","输出",NULL,NULL,"6");
