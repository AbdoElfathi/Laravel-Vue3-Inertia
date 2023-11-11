<template>
    <Box>
        <template #header>Offer #{{ count }} <span v-if="offer.accepted_at"
                class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1 text-xs">accepted</span></template>
        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-xl" />

                <div class="text-gray-500">
                    Difference :
                    <Price :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by {{ offer.bidder.name }}
                </div>

                <div class="text-gray-500 text-sm">
                    Made on : {{ madeOn }}
                </div>
            </div>
            <div v-if="!isSold">
                <Link :href="route('realtor.offer.accept', offer.id)" method="PUT" class="btn-success text-xs font-medium"
                    as="button">
                Accept</Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    count: Number,
    isSold: Boolean
})

const difference = computed(() => props.offer.amount - props.listingPrice)

const madeOn = computed(() => new Date(props.offer.created_at).toLocaleString())

</script>