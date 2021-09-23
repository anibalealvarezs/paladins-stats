<template>
    <Container>
        <slot>
            <Header>
                <slot>
                    <TrHead :fields="fields" :allowed="allowed" />
                </slot>
            </Header>
            <Body :id="model+'-table-rows'">
            <slot>
                <TrBody v-for="dummy in dummys" :item="dummy" :fields="fields" :hiddenid="buildHiddenId" :allowed="allowed" :data-id="dummy.id" :data-group="dummy.parent" :data-pos="getRowPos(dummy)" @clicked-edit-item="onItemClicked" />
            </slot>
            </Body>
        </slot>
        <div v-if="existsFormButton" :id="buildHiddenId" class="infinite-hidden">
            <DummyForm :data="data" :keyid="generateRandom" :key="itemFormKey" :defaults="defaults" :required="required" />
        </div>
    </Container>
</template>

<script>
import { TableFields as Table } from "Pub/js/Projectbuilder/projectbuilder"
import Sortable from "sortablejs"
import PbTable from "Pub/js/Projectbuilder/pbtable"
import DummyForm from "@/Pages/Dummy/Paladins/DummyForm";

export default {
    extends: PbTable,
    name: "TableDummies",
    props: {
        dummys: Object,
    },
    components: {
        DummyForm,
    },
    mounted() {
        if (this.sort) {
            let that = this
            let sortingOptions = Object.assign(
                {},
                Table.getSortingOptions(),
                {
                    onSort: function (e) {
                        let data = {
                            sortlist: that.getTablePositions(e.item.dataset.group)
                        }
                        that.$inertia.post(
                            '/dummys/sort/'+e.item.dataset.group,
                            data,
                            {
                                preserveState: false,
                            }
                        )
                    },
                }
            );

            Sortable.create(
                document.getElementById(this.model+'-table-rows'),
                sortingOptions
            )
        }
    },
    setup(props) {
        const allowed = props.allowed
        const table = new Table(props.showid, props.sort)
        table.customField(
            "name",
            "Dummy",
            {},
            {},
            {},
            {
                route: "dummys.show",
                id: true
            }
        )
        table.customField(
            "description",
            "Description",
        )
        table.customField(
            "alt",
            "Alt",
        )
        table.customField(
            "url",
            "URL",
            {},
            {
                centered: true,
                width: "w-12",
            },
        )
        table.customField(
            "permission",
            "Permission",
            {},
            {
                centered: true,
                width: "w-12",
            },
        )
        table.customField(
            "module",
            "Module",
            {},
            {
                centered: true,
                width: "w-12",
            },
        )
        table.pushActions({
            "update": {
                text: 'Edit',
                style: 'secondary',
                method: 'PUT',
                route: "dummys.edit",
                formitem: "dummy",
                altforuser: {},
                allowed: allowed.update,
            },
            "delete": {
                text: 'Delete',
                style: 'danger',
                method: 'DELETE',
                route: "dummys.destroy",
                formitem: "dummy",
                altforuser: {},
                allowed: allowed.delete,
            }
        })
        let fields = table.fields
        return { fields }
    },
}
</script>

<style scoped>

</style>
