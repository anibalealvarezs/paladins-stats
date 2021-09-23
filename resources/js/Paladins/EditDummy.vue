<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit: {{ dmdummy.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <DummyForm :data="setItem" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
import PbEdit from "Pub/js/Projectbuilder/pbedit"
import DummyForm from "@/Pages/Dummy/Paladins/DummyForm";

export default {
    extends: PbEdit,
    name: "EditDummy",
    props: {
        dmdummy: Object,
    },
    components: {
        DummyForm,
    },
    computed: {
        setItem() {
            this.dmdummy.item = this.dmdummy.id
            return this.dmdummy
        },
    },
    setup () {
        const defaults = computed(() => usePage().props.value.shared.defaults)
        const required = computed(() => usePage().props.value.shared.required)

        return { defaults, required }
    }
}
</script>

<style scoped>

</style>
