//
//  ActityRootViewController.m
//  TheParty
//
//  Created by macmini on 2018/8/3.
//  Copyright © 2018年 macmini. All rights reserved.
//

#import "ActityRootViewController.h"
#import "ActityListTableViewCell.h"
#import "ActityWebViewController.h"
@interface ActityRootViewController ()<UITableViewDelegate,UITableViewDataSource>
{
    UITableView *tableView;
    NSMutableArray *dataArr;
    NSInteger page;
    NSString *NewsID;
}

@end

@implementation ActityRootViewController

- (void)viewWillAppear:(BOOL)animated {
    [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(createFormData:) name:@"ActityData" object:nil];
    [super viewWillAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated {
   
    [super viewWillDisappear:animated];
}



-(void)dealloc
{
    NSLog(@"RootViewController dealloc--");
}

- (void)viewDidLoad {
    [super viewDidLoad];
    NewsID = @"";
    dataArr = [[NSMutableArray alloc] init];
    self.view.backgroundColor =COLOR(249, 245, 245);
    self.edgesForExtendedLayout = UIRectEdgeNone;
    [self ctreatTableView];
    
}

///加载数据
-(void)rootLoadData:(NSInteger)index
{
    [dataArr removeAllObjects];
    NewsID = [NSString stringWithFormat:@"%zd",index];
    [self createData];
    
}

- (void)createFormData:(NSNotification *)dic{
    if ([dic.userInfo[@"type"]  isEqualToString:NewsID]) {
        [self createData];
    }
    
}

- (void)createData{
    [dataArr removeAllObjects];
    [self showHUD:nil];
    WEAKSELF
    NSString *biz=[NSString stringWithFormat:@"&type=%@",NewsID];
    [ConnectionRequestMgr GetSessionWithUrl:ActivityList parameter:biz successBlock:^(NSDictionary *dict) {
        [weakSelf hideHUD];
        if ([dict[@"code"] integerValue] == 1) {
            if ( ! [ dict[@"data"] isEqual:[NSNull null] ] ) {
                for (int i = 0; i< [dict[@"data"] count]; i++) {
                    [dataArr addObject:dict[@"data"][i]];
                }
            }
            if (dataArr.count == 0) {
                [weakSelf viewthephoto:@"NoList" andtitle:@"暂无内容"];
            }else{
                [weakSelf removeView];
            }
            [tableView reloadData];
        }else{
            [weakSelf showError:dict[@"msg"]];
        }
    } failBlock:^(NSString *errorStr) {
      
        [weakSelf hideHUD];
        [weakSelf showError:errorStr];
    }];
    
}

- (void)ctreatTableView{
    tableView = [[UITableView alloc] initWithFrame:CGRectMake(0, 0, SCREEN_W, SCREEN_H -64-44) style:UITableViewStyleGrouped];
    tableView.backgroundColor = COLOR(249, 245, 245);
    tableView.delegate = self;
    tableView.separatorStyle = NO;
    tableView.dataSource = self;
    tableView.showsVerticalScrollIndicator = FALSE;
    tableView.showsHorizontalScrollIndicator = FALSE;
    tableView.tableFooterView = [[UIView alloc] init];
    [self.view addSubview:tableView];
    
    tableView.estimatedRowHeight = 0;
    tableView.estimatedSectionHeaderHeight = 0;
    tableView.estimatedSectionFooterHeight = 0;
    
    [tableView registerNib:[UINib nibWithNibName:@"ActityListTableViewCell" bundle:nil] forCellReuseIdentifier:@"ActityListTableViewCell"];

}


#pragma mark UItableViewDelegate
- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section{
    return dataArr.count;
}

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView{
    return 1;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath{
    ActityListTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:@"ActityListTableViewCell"];
     cell.selectionStyle = UITableViewCellSelectionStyleNone;
    cell.titleL.text = dataArr[indexPath.row][@"name"];
    cell.deline.text = [NSString stringWithFormat:@"%@ 报名截止",dataArr[indexPath.row][@"apply_etime"]];
    cell.numL.text = [NSString stringWithFormat:@"%@人参加",dataArr[indexPath.row][@"applied"]];

        if ([dataArr[indexPath.row][@"is_past"] integerValue] == 1) {
            cell.typeL.backgroundColor = UIColorFromRGBA(0x999999, 1);
            cell.typeL.text = @"已结束";
        }else{
            if ([dataArr[indexPath.row][@"is_apply"] integerValue] == 0) {
                cell.typeL.backgroundColor = [UIColor redColor];
                cell.typeL.text = @"报名中";
            }else{
                cell.typeL.backgroundColor = UIColorFromRGBA(0xfacc2b, 1);
                cell.typeL.text = @"已报名";
            }
        }
    return cell;
}

- (CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath{
    return 73;
}

- (CGFloat)tableView:(UITableView *)tableView heightForFooterInSection:(NSInteger)section{
    return 0.01;
}

- (CGFloat)tableView:(UITableView *)tableView heightForHeaderInSection:(NSInteger)section{
    return 4;
}

- (UIView *)tableView:(UITableView *)tableView viewForHeaderInSection:(NSInteger)section{
    UIView *view = [[UIView alloc] initWithFrame:CGRectMake(0, 0, SCREEN_W, 4)];
    view.backgroundColor = COLOR(249, 245, 245);
    return view;
}

- (UIView *)tableView:(UITableView *)tableView viewForFooterInSection:(NSInteger)section{
    UIView *view = [[UIView alloc] initWithFrame:CGRectMake(0, 0, SCREEN_W, 0.1)];
    return view;
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath{
    [[UIHelper sharedSingleton] pushVC:@"ActityWebViewController" vc:self parames:@{@"dic":dataArr[indexPath.row],@"type":NewsID}];
}


@end