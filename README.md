# bochi-server
ぼちぼち開発やって、サーバーを作る。

このサーバは公開開発方式のサーバーです。
みんなでいいサーバーを作ろうというプロジェクトになります。
Let's Pull requests!

## 開発用のメモ
事前にMySQLサーバーのご用意を!
```MySQL
create table players(
  id int primary key auto_increment,
  name VARCHAR(40) not null,
  quest_join_times int not null,
  level int not null,
  exp int not null 
);
```

# bochi-server
Develop little by little and make the server.

This server is developed in public.
This is project that was made by Everyone.
Let's pull requests!
