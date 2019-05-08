<template>
  <div class="signin">
    <h1>This is a sign in page
      <span v-if="$root.serverStuff">
        {{ $root.serverStuff.test }}
      </span>
    </h1>
  </div>
</template>

<style lang="stylus">

</style>
