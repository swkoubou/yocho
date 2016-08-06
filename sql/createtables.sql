-- 登録情報
create table ivent (
  ivent_id int(11) NOT NULL AUTO_INCREMENT,
  ivent_name varchar(127),
  participants varchar(8000),
  dates varchar(8000),
  url varchar(255),
  deadline varchar(127),
  PRIMARY KEY (ivent_id)
);

-- 参加者情報
create table marubatu (
  ivent_id int(11),
  participant varchar(63),
  dates varchar(8000),
  status varchar(8000),
  FOREIGN KEY (ivent_id) REFERENCES ivent(ivent_id)
);
