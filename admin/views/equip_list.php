<!DOCTYPE HTML>
<html>
<head>
<title>设备列表页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<div class="detail-section">
    <div class="row">
        <form id="searchForm" method="post" class="form-horizontal">
        <div class="row">
            <div class="control-group span4">
                <div class="controls" >
                    <select name="product_id" id="product_id" selected="">
                        <option value="0">请选择产品型号</option>
                        <option value="1">产品一</option>
                        <option value="2">产品二</option>
                    </select>
                </div>
            </div>
            <div class="control-group span4">
                <div class="controls">
                    <select name="s_key">
                        <option value="">请选择查询方式</option>                    
                        <option value="device_location">按地区</option>
                        <option value="device_sn">按序列号</option>  
                        <option value="device_mac">按MAC</option>  
                    </select>
                </div>
            </div>
            <div class="control-group span4">
                <div class="controls">
                    <input type="text" class="control-text" name="s_value" placeholder="请输入关键字" value="">
                </div>
            </div>

            <div class="control-group span9">
                <div class="controls">
                    <label class="control-label">启用时间：</label>
                    <input type="text" class="calendar" name="start_date" value=""><span> - </span>
                    <input name="end_date" type="text" class="calendar" value="">
                </div>
            </div>
            <div class="span2 offset2">
                <button type="submit" id="btnSearch" class="button button-primary">查询</button>
            </div>
        </div>
        </form>
    </div>
    
    <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
        </div>
    </div>
</div>
   
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
 <script type="text/javascript">
    BUI.use('bui/calendar',function(Calendar){
    var datepicker = new Calendar.DatePicker({
    trigger:'.calendar',
    autoRender : true
    });
    });
</script>
<script type="text/javascript">
    BUI.use('common/page');
</script>
<script type="text/javascript">
  BUI.use('common/search',function (Search) {
    
      editing = new BUI.Grid.Plugins.DialogEditing({
        triggerCls : 'btn-edit'
      }),
    columns = [
        {title:'设备序列号',dataIndex:'device_sn',width:100},
        {title:'设备型号',dataIndex:'device_cat',width:100},    
        {title:'设备MAC',dataIndex:'device_mac',width:100},
        {title:'所在地区',dataIndex:'device_location',width:100},
        {title:'设备状态',dataIndex:'device_desc1',width:100},    
        {title:'运行时长',dataIndex:'device_desc2',width:100}   
        ],
      store = Search.createStore('../data/eq_list',{
        proxy : {
          method : 'POST'
        },
        pageSize:5
      }),
      gridCfg = Search.createGridCfg(columns,{
        plugins : [editing,BUI.Grid.Plugins.CheckSelection,BUI.Grid.Plugins.AutoFit] // 插件形式引入多选表格
      });

    var  search = new Search({
        store : store,
        gridCfg : gridCfg
      }),
      grid = search.get('grid');

  });
</script>

<body>
</html>  