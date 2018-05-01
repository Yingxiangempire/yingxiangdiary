<template>
            <el-footer>
                 <!-- To the right -->
                 <div class="pull-right hidden-xs"><b>Version</b> 2.4.3</div>
                 <!-- Default to the left -->
                 <strong>Copyright © 2017 <a href="/">AdminLTE.IO</a>.</strong> All rights reserved.
            </el-footer>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style>
.el-footer {
    background-color: #B3C0D1;
    color: #333;
    text-align: center;
    line-height: 60px;
  }
</style>

