<template>
      <div>
   <el-col :span="24" class="topbar-wrap">
      <div class="topbar-logo topbar-btn">
        <a href="/"><img src="../../assets/logo.png" style="padding-left:8px;"></a>
      </div>
      <div class="topbar-account topbar-btn">
        <el-dropdown trigger="click">
          <span class="el-dropdown-link userinfo-inner"><i class="iconfont icon-user"></i> {{nickname}}  <i
            class="iconfont icon-down"></i></span>
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item>
              <div @click="jumpTo('/user/profile')"><span style="color: #555;font-size: 14px;">个人信息</span></div>
            </el-dropdown-item>
            <el-dropdown-item>
              <div @click="jumpTo('/user/changepwd')"><span style="color: #555;font-size: 14px;">修改密码</span></div>
            </el-dropdown-item>
            <el-dropdown-item divided @click.native="logout">退出登录</el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
      </div>
    </el-col>
      </div>
</template>

<script>
export default {
  data() {
    return {
      activeIndex: "1",
      activeIndex2: "1"
    };
  },
  methods: {
    handleSelect(key, keyPath) {
      console.log(key, keyPath);
    }
  }
};
</script>
<style scoped lang="scss">
.container {
  position: absolute;
  top: 0px;
  bottom: 0px;
  width: 100%;

  .topbar-wrap {
    height: 50px;
    line-height: 50px;
    background: #373d41;
    padding: 0px;

    .topbar-btn {
      color: #fff;
    }
    /*.topbar-btn:hover {*/
    /*background-color: #4A5064;*/
    /*}*/
    .topbar-logo {
      float: left;
      width: 59px;
      line-height: 26px;
    }
    .topbar-logos {
      float: left;
      width: 120px;
      line-height: 26px;
    }
    .topbar-logo img,
    .topbar-logos img {
      height: 40px;
      margin-top: 5px;
      margin-left: 2px;
    }
    .topbar-title {
      float: left;
      text-align: left;
      width: 200px;
      padding-left: 10px;
      border-left: 1px solid #000;
    }
    .topbar-account {
      float: right;
      padding-right: 12px;
    }
    .userinfo-inner {
      cursor: pointer;
      color: #fff;
      padding-left: 10px;
    }
  }
  .main {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    position: absolute;
    top: 50px;
    bottom: 0px;
    overflow: hidden;
  }

  aside {
    min-width: 50px;
    background: #333744;
    &::-webkit-scrollbar {
      display: none;
    }

    &.showSidebar {
      overflow-x: hidden;
      overflow-y: auto;
    }

    .el-menu {
      height: 100%; /*写给不支持calc()的浏览器*/
      height: -moz-calc(100% - 80px);
      height: -webkit-calc(100% - 80px);
      height: calc(100% - 80px);
      border-radius: 0px;
      background-color: #333744;
      border-right: 0px;
    }

    .el-submenu .el-menu-item {
      min-width: 60px;
    }
    .el-menu {
      width: 180px;
    }
    .el-menu--collapse {
      width: 60px;
    }

    .el-menu .el-menu-item,
    .el-submenu .el-submenu__title {
      height: 46px;
      line-height: 46px;
    }

    .el-menu-item:hover,
    .el-submenu .el-menu-item:hover,
    .el-submenu__title:hover {
      background-color: #7ed2df;
    }
  }

  .menu-toggle {
    background: #4a5064;
    text-align: center;
    color: white;
    height: 26px;
    line-height: 30px;
  }

  .content-container {
    background: #fff;
    flex: 1;
    overflow-y: auto;
    padding: 10px;
    padding-bottom: 1px;

    .content-wrapper {
      background-color: #fff;
      box-sizing: border-box;
    }
  }
}
</style>