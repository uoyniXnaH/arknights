--
-- recruitment labels
--

CREATE TABLE IF NOT EXISTS recruitment_label (
  value varchar(20) NOT NULL UNIQUE,
  type varchar(20) NOT NULL
);

INSERT INTO recruitment_label (`value`,`type`)
VALUES
("新手","qualification"),
("资深干员","qualification"),
("高级资深干员","qualification"),
("近战位","position"),
("远程位","position"),
("近卫","class"),
("医疗","class"),
("先锋","class"),
("术师","class"),
("狙击","class"),
("重装","class"),
("辅助","class"),
("特种","class"),
("治疗","affix"),
("支援","affix"),
("输出","affix"),
("群攻","affix"),
("减速","affix"),
("生存","affix"),
("防护","affix"),
("削弱","affix"),
("位移","affix"),
("控场","affix"),
("爆发","affix"),
("召唤","affix"),
("快速复活","affix"),
("费用回复","affix"),
("支援机械","affix");
