<template>
    <form @submit.prevent="submit" class="w-full max-w-lg">
        <div class="flex flex-wrap -mx-3 mb-6">
            <!-- dummy -->
            <div v-if="ignoreDummy" class="mt-2" v-show="!dummyPreview">
                <img :src="getDummyUrl" :alt="form.alt" class="h-40 w-40 object-cover">
            </div>
            <div v-else class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-dummy-' + keyid">
                    Dummy
                </label>
                <input
                    :id="'grid-dummy-' + keyid"
                    name="dummy"
                    ref="dummy"
                    type="file"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    :required="isRequired('dummy')"
                    @change="updateDummyPreview"
                    @input="form.dummy = $event.target.files[0]"
                >
            </div>
            <!-- name -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-name-' + keyid">
                    Name
                </label>
                <input
                    v-model="form.name"
                    :id="'grid-name-' + keyid"
                    name="name"
                    type="text"
                    placeholder="Name"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    readonly="true"
                    :required="isRequired('name')"
                    @mouseover="disableReadonly"
                    @focus="disableReadonly"
                >
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-description-' + keyid">
                    Description
                </label>
                <input
                    v-model="form.description"
                    :id="'grid-description-' + keyid"
                    name="description"
                    type="text"
                    placeholder="Description"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    readonly="true"
                    :required="isRequired('description')"
                    @mouseover="disableReadonly"
                    @focus="disableReadonly"
                >
            </div>
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-alt-' + keyid">
                    Alt
                </label>
                <input
                    v-model="form.alt"
                    :id="'grid-alt-' + keyid"
                    name="alt"
                    type="text"
                    placeholder="Alt"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    readonly="true"
                    :required="isRequired('alt')"
                    @mouseover="disableReadonly"
                    @focus="disableReadonly"
                >
            </div>
            <!-- permission -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" :for="'grid-permission-' + keyid">
                    Permission
                </label>
                <select
                    v-model="form.permission"
                    :id="'grid-permission-' + keyid"
                    name="permission"
                    class="appearance-none w-full md:w-1/1 px-4 py-3 mb-3 block rounded bg-gray-200 text-gray-700 border border-gray-200 overflow-hidden leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="Select permission"
                    :required="isRequired('permission')"
                >
                    <option value="public">
                        Public
                    </option>
                    <option value="private">
                        Private
                    </option>
                </select>
            </div>
            <!-- module -->
            <div class="w-full px-3 mb-6 md:mb-0">
                <input
                    v-model="form.module"
                    :id="'grid-module-' + keyid"
                    name="module"
                    type="hidden"
                >
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2 items-center justify-between">
            <!-- submit -->
            <div class="w-full px-3">
                <Button type="submit" :disabled="form.processing">{{ buttontext }}</Button>
            </div>
        </div>
    </form>
</template>

<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import Swal from "sweetalert2"
import PbForm from "Pub/js/Projectbuilder/pbform"

export default {
    extends: PbForm,
    name: "DummyForm",
    data() {
        return {
            dummyPreview: null,
            ignoreDummy: (this.data.name ? true : false),
        }
    },
    setup (props) {
        const form = reactive({
            name: props.data.name,
            description: props.data.description,
            mime: props.data.mime_type,
            dummy: null,
            alt: props.data.alt,
            url: props.data.url,
            module: (props.data.module ? props.data.module : 'dummy'),
            permission: (props.data.permission ? props.data.permission : (props.defaults.hasOwnProperty('permission') ? props.defaults.permission : 'public')),
        })

        function submit() {
            if (props.data.hasOwnProperty('item')) {
                Inertia.put("/dummys/"+ props.data.item, form, {
                    preserveScroll: true,
                    onSuccess: () => Swal.close()
                })
            } else {
                Inertia.post("/dummys", form, {
                    preserveScroll: true,
                    preserveState: false,
                    onSuccess: () => Swal.close()
                })
            }
        }

        return { form, submit }
    },
    methods: {
        updateDummyPreview() {
            const reader = new DummyReader();

            reader.onload = (e) => {
                this.dummyPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.dummy.files[0]);
        },
    },
    computed: {
        getDummyUrl() {
            return (this.form.mime.includes('image/') ? this.form.url : '#')
        }
    }
}
</script>

<style scoped>

</style>
