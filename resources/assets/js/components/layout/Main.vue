<template>
  <section class="content-container">
        <div class="grid-content bg-purple-light">
          <el-col :span="24" class="content-wrapper">
            <transition name="fade" mode="out-in">
              <router-view></router-view>
            </transition>
          </el-col>
        </div>
      </section>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>