//
//  AppDelegate.m
//  TheParty
//
//  Created by macmini on 2018/7/31.
//  Copyright © 2018年 macmini. All rights reserved.
//

#import "AppDelegate.h"
#import <UMSocialCore/UMSocialCore.h>

#define USHARE_DEMO_APPKEY @"5ba1c41d5b5a55ac33000258"

@interface AppDelegate ()

@end

@implementation AppDelegate


- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
    // Override point for customization after application launch.
    
    [NSThread sleepForTimeInterval:1];
    [[UMSocialManager defaultManager] openLog:YES];

    [UMSocialGlobal shareInstance].isClearCacheWhenGetUserInfo = NO;
    
    [[UMSocialManager defaultManager] setUmSocialAppkey:USHARE_DEMO_APPKEY];
    [self configUSharePlatforms];
    
    [UIApplication sharedApplication].statusBarStyle = UIStatusBarStyleLightContent;
    self.window = [[UIWindow alloc] initWithFrame:[UIScreen mainScreen].bounds];
    self.window.backgroundColor = [UIColor whiteColor];
    [self createRootViewController];
    return YES;
}

- (void)configUSharePlatforms{
    
    
    [[UMSocialManager defaultManager] setPlaform:UMSocialPlatformType_WechatSession appKey:@"wx1939f863457962e3" appSecret:@"c460815f7df9138a48e444c8518cf454" redirectURL:@"http://www.umeng.com/social"];
    
}

- (void)loginOut{
    ThePartySingTon *inscane = [ThePartySingTon SharedInstance];
    inscane.isLogin = NO;
    inscane.user = nil;
}

- (void)createRootViewController{
    RootNavigationController *nav = [[RootNavigationController alloc] initWithRootViewController:[[HomeViewController alloc] init]];
    self.window.rootViewController = nav;
}


- (BOOL)application:(UIApplication *)application handleOpenURL:(NSURL *)url
{
    BOOL result = [[UMSocialManager defaultManager] handleOpenURL:url];
    if (!result) {
        // 其他如支付等SDK的回调
    }
    return result;
}

- (void)applicationWillResignActive:(UIApplication *)application {
    // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
    // Use this method to pause ongoing tasks, disable timers, and invalidate graphics rendering callbacks. Games should use this method to pause the game.
}


- (void)applicationDidEnterBackground:(UIApplication *)application {
    // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
    // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
}


- (void)applicationWillEnterForeground:(UIApplication *)application {
    // Called as part of the transition from the background to the active state; here you can undo many of the changes made on entering the background.
}


- (void)applicationDidBecomeActive:(UIApplication *)application {
    // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
}


- (void)applicationWillTerminate:(UIApplication *)application {
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
}


@end