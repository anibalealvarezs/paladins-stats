<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dummies
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between w-full">
                        <Button
                            v-if="allowed.create"
                            @click="loadForm"
                            type="button"
                        >
                            <slot>Create Dummy</slot>
                        </Button>
                        <div id="breadcrumb"></div>
                    </div>
                    <TableDummies :dummys="dmdummys" :allowed="allowed" :sort="sort" :showpos="showpos" :showid="showid" :model="model" :defaults="defaults" :required="required" />
                </div>
            </slot>
            <div :id="buildHiddenId" class="infinite-hidden">
                <DummyForm :data="{}" :defaults="defaults" :required="required" />
            </div>
        </Main>
    </AppLayout>
</template>

<script>
import {computed} from "vue"
import {usePage} from "@inertiajs/inertia-vue3"
import PbIndex from "Pub/js/Projectbuilder/pbindex"
import DummyForm from "@/Pages/Dummy/Paladins/DummyForm";
import TableDummies from "@/Pages/Dummy/Paladins/TableDummies";

export default {
    extends: PbIndex,
    name: "Dummies",
    props: {
        dmdummys: Object
    },
    components: {
        DummyForm,
        TableDummies,
    },
    setup () {
        const allowed = computed(() => usePage().props.value.shared.allowed)
        const sort = computed(() => usePage().props.value.shared.sort)
        const showpos = computed(() => usePage().props.value.shared.showpos)
        const showid = computed(() => usePage().props.value.shared.showid)
        const model = computed(() => usePage().props.value.shared.model)
        const defaults = computed(() => usePage().props.value.shared.defaults)
        const required = computed(() => usePage().props.value.shared.required)

        return { allowed, sort, model, showpos, showid, defaults, required }
    }
}
</script>
