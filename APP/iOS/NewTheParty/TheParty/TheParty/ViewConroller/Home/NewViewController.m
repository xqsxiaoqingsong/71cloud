//
//  NewViewController.m
//  TheParty
//
//  Created by macmini on 2018/7/31.
//  Copyright © 2018年 macmini. All rights reserved.
//

#import "NewViewController.h"
#import "XYYSegmentControl.h"
#import "RootViewController.h"
#import "NewRootViewController.h"
#import "NewsWebViewController.h"

@interface NewViewController ()<XYYSegmentControlDelegate>
@property (nonatomic, strong) XYYSegmentControl *slideSwitchView;
@property (nonatomic,strong)  NSMutableArray *itemArray;
@property (nonatomic,strong)  NSMutableArray *Arr;

@end

@implementation NewViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view.
    self.title = @"党建要闻";
    self.Arr = [[NSMutableArray alloc] init];
    self.itemArray = [[NSMutableArray alloc] init];
    [self creatData];
 
}

- (void)creatData{
    [self showHUD:nil];
    WEAKSELF
    [ConnectionRequestMgr GetSessionWithUrl:PartyClass parameter:nil successBlock:^(NSDictionary *dict) {
        
        [weakSelf hideHUD];
        if ([dict[@"code"] integerValue] == 1) {
            for (int i = 0;  i<[dict[@"data"] count]; i++) {
                [self.Arr addObject:dict[@"data"][i]];
                [self.itemArray addObject:dict[@"data"][i][@"name"]];
            }
            [self buildSegment];
        }else{
            [weakSelf showError:dict[@"msg"]];
        }
    } failBlock:^(NSString *errorStr) {
        [weakSelf hideHUD];
        [weakSelf showError:errorStr];
    }];
}

#pragma mark - 配置segment
-(void)buildSegment
{
    
    self.slideSwitchView = [[XYYSegmentControl alloc]initWithFrame:CGRectMake(0 , 0 , self.view.frame.size.width, self.view.frame.size.height) channelName:[self.itemArray copy] source:self];
    [self.slideSwitchView setUserInteractionEnabled:YES];
    //XYYSegmentControl代理
    self.slideSwitchView.segmentControlDelegate = self;
    ///被注释的代码可以调整整个segment 样式颜色值。
    //    //设置tab 颜色(可选)
        self.slideSwitchView.tabItemNormalColor = UIColorFromRGBA(0x999999, 1);
    //    //设置tab 被选中的颜色(可选)
        self.slideSwitchView.tabItemSelectedColor = [UIColor redColor];
    //    //设置tab 背景颜色(可选)
    //    self.slideSwitchView.tabItemNormalBackgroundColor = [UIColor lightGrayColor];
    //    //设置tab 被选中的标识的颜色(可选)
    self.slideSwitchView.tabItemNormalFont = 16;
    self.slideSwitchView.tabItemSelectionIndicatorColor = [UIColor redColor];
    [self.view addSubview:self.slideSwitchView];
}

-(NSUInteger)numberOfTab:(XYYSegmentControl *)view
{
    return [self.itemArray count];//items决定
}

///待加载的控制器
-(UIViewController *)slideSwitchView:(XYYSegmentControl *)view viewOfTab:(NSUInteger)number
{
    NewRootViewController *root = [[NewRootViewController alloc] init];
    //    [self addChildViewController:root];
    root.title = _itemArray[number];
    return root;
}

- (void)slideSwitchView:(XYYSegmentControl *)view didselectTab:(NSUInteger)number
{
    NewRootViewController *root = view.viewArray[number];
    [root rootLoadData:number andArr:self.Arr[number]];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender {
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

@end
