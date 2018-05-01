<template lang="html">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">新增一级导航</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">导航名称</label>


                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="导航路由">
                  </div>
                </div>
                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-2 control-label">导航图标</label>

                                  <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="导航图标">
                                  </div>
                                </div>
                <div class="form-group">

                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Sign in</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
</template>

<script>
export default {
  name:'navigation',
  components: {
  }
}
</script>