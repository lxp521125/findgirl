加用户：
---
?act=addUser&name=12e3&equipment={ams}&ip=132.23.113.23
```
    act    方法名
    name      名字
    equipment  json的设备信息
    ip   ip地址
```
加位置：
act=addPosition&x=39.98123848&y=116.30683690&user_id=1

加消息：
?act=addMessage&from_user_id=1&to_user_id=2&message=1asdf

消息列表
?act=getMessageList&to_user_id=2

查询某个用户发送的信息列表
?act=getMessageListByFromUserId&from_user_id=1&to_user_id=2

//更新消息为已读
?setMessage&message_id=1,2,3

用户课程信息
?act=getUserOtherList&user_id=1,2,3

更新用户在线时间
?act=setOnline&user_id=2

//获取在线人数
?act=getOnlineCount