<template>
  <Link :href="$route('listing.create')">New Listing</Link>
 
  <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
      <div class="container mx-auto">
        <nav class="p-4 flex items-center justify-between">
          <div class="text-lg font-medium">
            <Link :href="route('listing.index')">Listings</Link>
          </div>
          <div>
            <!-- <Link :href="route('listing.index')"> Larazillow </Link> -->
          </div>
          <div>x</div>
        </nav>
      </div>
  </header>

  <div v-if="flashSuccess" class="success">
    {{ flashSuccess }}
  </div>

  <slot>Default</slot>

</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue';

    const page = usePage();
    const flashSuccess = computed(() => page.props.flash.success)

</script>