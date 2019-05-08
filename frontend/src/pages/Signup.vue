<template>
  <div class="signup">
    <h1>This is a sign up page
      <span v-if="$root.serverStuff">
        {{ $root.serverStuff.test }}
      </span>
    </h1>
  </div>
</template>
