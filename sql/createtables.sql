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

insert into ivent values(
  1,
  '飲み会',
  '染谷,高畑,浦野',
  '8/6,8/7,8/8,8/9',
  'http://hogehoge.com',
  '2016/8/1'
);

insert into marubatu values(
  1,
  '染谷',
  '8/6,8/7,8/8,8/9',
  'o,x,o,o'
);

insert into marubatu values(
  1,
  '高畑',
  '8/6,8/7,8/8,8/9',
  'o,x,x,x'
);

insert into marubatu values(
  1,
  '浦野',
  '8/6,8/7,8/8,8/9',
  'o,o,o,o'
);

insert into ivent values(
  null,
  'テスト',
  '染谷,高畑,浦野',
  '8/6',
  'http://hogehoge.com',
  '2016/8/1'
);
