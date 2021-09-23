<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Dummy
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <DummyForm :data="{}" :defaults="defaults" :required="required" />
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
import PbCreate from "Pub/js/Projectbuilder/pbcreate"
import DummyForm from "@/Pages/Dummy/Paladins/DummyForm";

export default {
    extends: PbCreate,
    name: "CreateDummy",
    components: {
        DummyForm,
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
