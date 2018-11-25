//
//  ConnectionRequestMgr.h
//  TTMN
//
//  Created by macmini on 2018/4/21.
//  Copyright © 2018年 lixin. All rights reserved.
//

#import <Foundation/Foundation.h>

// 本地地址/
//#define HTTPURL @"http://192.168.2.101/Api/"

// 服务器地址
#define HTTPURL @"https://api.cloudcpc.com/"


typedef void(^SuccessBlock)(NSDictionary *dict);
typedef void(^FailBlock)(NSString *errorStr);

@interface ConnectionRequestMgr : NSObject

// 注册验证码                     (GET)
#define sendSMS                 @"home/Login/sendMsg"
// 注册账号第一步                  (POST)
#define Loginregister           @"home/login/register"
// 注册账号第二步                  (POST)
#define Nextregister            @"home/Login/entry"
// 登录账号                      (POST)
#define login                   @"home/Login/login"
// 忘记密码手机验证                (POST)
#define FristForgetPass         @"User/modifyPass"
// 忘记密码                      (POST)
#define SecondForgetPass        @"home/Login/modifyPass"
// 公司                         (GET)
#define Organization            @"home/Login/tissue"
// 组织                         (POST)
#define Branchs                 @"home/Login/getBranchs"
// 微信登录                      (POST)
#define WechatLogin                   @"home/Login/wechat"




// 首页                         (GET)
#define HomeIndex               @"home/index/getIndex"
// 党建要闻列表页                 (GET)
#define PartyNewList            @"home/Party/getPartyNews"
// 党建要闻分类                   (GET)
#define PartyClass              @"home/Party/getPartyCate"
// 反腐列表页                     (GET)
#define ClearNewList            @"home/Clear/getClearNews"
// 反腐分类                       (GET)
#define ClearClass              @"home/Clear/getClearCate"
// 相册列表                       (GET)
#define PhotoList               @"home/Photo/getPhotoList"
// 相册详情                       (GET)
#define PhotoDetail             @"home/Photo/getPhotoDetail"
// 党史故事列表页                   (GET)
#define HistoryList             @"History/getHistory"
// 党史故事分类                     (GET)
#define HistoryClass            @"History/getHistoryCate"
// 党史故事详情                     (GET)
#define HistoryDetail           @"History/getHistoryDetail"
// 活动列表                         (GET)
#define ActivityList            @"home/Activity/getAct"
// 活动报名                         (POST)
#define ActivityBM              @"home/Activity/apply"
// 稿件分类                         (GET)
#define ContributeList          @"home/Heart/getCate"
// 红心列表                         (GET)
#define HeartList               @"home/Heart/getHeartList"
// 投稿                            (POST)
#define Contribute              @"home/Heart/contribute"
// 云展管                         (GET)
#define Cloud                   @"home/Cloud/getCloud"
// 通知分类                       (GET)
#define NoticeClass              @"home/Notice/getCate"
// 通知列表页                     (GET)
#define NoticeList               @"home/Notice/getNotice"
// 微党校分类                     (GET)
#define SchoolClass              @"/home/School/getCate"
// 课程表页                       (GET)
#define SchoolList               @"home/School/getClassList"
// 课程详情页                      (GET)
#define SchoolDetail             @"home/School/getDetail"
// 我的课程                        (GET)
#define SchoolUser                @"home/School/getUserClass"
// 加入学习计划                     (POST)
#define SchoolStudy               @"home/School/addStudy"
// 上传观看时间                     (POST)
#define SchoolSaveTime            @"home/School/saveTime"
// 意见反馈                         (POST)
#define Advice                    @"home/User/advice"
// 举报                            (POST)
#define Report                    @"home/Report/report"
// 新闻详情页点赞                    (POST)
#define Praise                    @"home/Praise/index"
// 个人中心                         (GET)
#define USER                      @"home/User/getUserIndex"
// 消息中心                         (GET)
#define UserMsg                   @"home/User/getUserMsg"
// 删除消息                         (POST)
#define DelMsg                    @"home/User/delMsg"
// 个人信息                         (POST)
#define UserEdit                  @"home/User/editUserInfo"
// 个人排行                         (GET)
#define PersonRank                @"home/User/getPersonRank"
// 公司排行                         (GET)
#define CompanyRank               @"home/User/getCompanyRank"
// 个人积分                         (GET)
#define ScoreDetail               @"home/User/getMyScoreDetail"


// 答题首页                         (POST)
#define examapiHome               @"home/examapi/index"
// 关卡选择                         (POST)
#define examapiChoose             @"home/examapi/getScoreQuestions"
// 答题                             (POST)
#define examapiQuestions          @"home/examapi/questions"
// 上传答案                          (POST)
#define examapiTranscript          @"home/examapi/transcript"
// 答题排行榜                         (POST)
#define examapiRanking          @"home/examapi/ranking"


/*
 * 网络请求(NSURLSession)
 * 参数：
 *     url:请求URL
 *     parameter:请求参数，无参数传nil
 *     success:请求成功
 *     failure:请求失败
 */
+ (void)PostSessionWithUrl:(NSString *)url parameter:(NSString *)parameter  successBlock:(SuccessBlock)success failBlock:(FailBlock)failure;



+ (void)GetSessionWithUrl:(NSString *)url parameter:(NSString *)parameter  successBlock:(SuccessBlock)success failBlock:(FailBlock)failure;


+ (void)POSTSessionWithUrl:(NSString *)url parameter:(id )parameter successBlock:(SuccessBlock)success failBlock:(FailBlock)failure;

+ (void)cancelAllRequest;



@end