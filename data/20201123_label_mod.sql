--
-- add column and set value for label table
--

ALTER TABLE recruitment_label
  ADD `attr` int;

UPDATE recruitment_label
  SET attr=1
  WHERE value="高级资深干员";
