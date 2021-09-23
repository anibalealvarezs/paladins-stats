<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dummy: {{ dmdummy.name }}
            </h2>
        </template>

        <Main>
            <slot>
                <div class="p-12 sm:px-20 bg-white border-b border-gray-200">
                    <h2>{{ dmdummy.id }}. {{ dmdummy.name }}</h2>
                </div>
            </slot>
        </Main>
    </AppLayout>
</template>

<script>
import PbShow from "Pub/js/Projectbuilder/pbshow"

export default {
    extends: PbShow,
    name: "ShowDummy",
    props: {
        dmdummy: Object,
    },
}
</script>

<style scoped>

</style>
