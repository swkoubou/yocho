-- 登録情報
create table event (
  event_id int(11) NOT NULL AUTO_INCREMENT,
  event_name varchar(127),
  participants varchar(8000),
  dates varchar(8000),
  url varchar(255),
  deadline varchar(127),
  PRIMARY KEY (event_id)
);

-- 参加者情報
create table marubatu (
  event_id int(11),
  participant varchar(63),
  dates varchar(8000),
  status varchar(8000),
  FOREIGN KEY (event_id) REFERENCES event(event_id)
);

insert into event values(
  1,
  '飲み会',
  '染谷,高畑,浦野',
  '8/6,8/7,8/8,8/9',
  'http://hogehoge.html',
  '2016/8/1'
);

insert into marubatu values(
  28,
  'someya',
  '2016/8/10,8/11',
  '-,-'
);

insert into marubatu values(
  28,
  'tibimosu',
  '2016/8/10,8/11',
  '-,-'
);

insert into marubatu values(
  28,
  'uryoya',
  '2016/8/10,8/11',
  '-,-'
);

insert into event values(
  null,
  'テスト',
  '染谷,高畑,浦野',
  '8/6',
  'http://hogehoge.com',
  '2016/8/1'
);
