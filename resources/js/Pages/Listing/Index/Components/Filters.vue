
<template>
    <div>
        <form @submit.prevent="filter">
            <div class="mb-8 mt-4 flex flex-wrap gap-2">
                <div class="flex flex-nowrap items-center">
                    <input v-model.number="form.priceFrom" type="text" placeholder="Price from"
                        class="input-filter-l w-28" />
                    <input v-model.number="form.priceTo" type="text" placeholder="Price to" class="input-filter-r w-28" />
                </div>

                <div class="flex flex-nowrap items-center">
                    <select v-model="form.beds" class="input-filter-l w-28">
                        <option :value="null">Beds</option>
                        <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                        <option>+6</option>
                    </select>
                    <select v-model="form.baths" class="input-filter-r w-28">
                        <option :value="null">Baths</option>
                        <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                        <option>+6</option>

                    </select>
                </div>

                <div class="flex flex-nowrap items-center">
                    <input v-model.number="form.areaFrom" type="text" placeholder="Area from" class="input-filter-l w-28" />
                    <input v-model.number="form.areaTo" type="text" placeholder="Price to" class="input-filter-r w-28" />
                </div>

                <button type="submit" class="btn-normal">Filter</button>
                <button type="reset" @click="clear" class="btn-outline">Clear</button>
            </div>

        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    filters: Object
})

const form = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null
})

const filter = () => {
    form.get(route('listing.index', {
        preserveState: true,
        preserveScroll: true
    }))
}

const clear = () => {
    form.priceFrom = null;
    form.priceTo = null;
    form.beds = null;
    form.baths = null;
    form.areaFrom = null;
    form.areaTo = null;
    filter();
}
</script>
