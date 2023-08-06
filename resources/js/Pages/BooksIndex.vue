<script>
import {defineComponent} from 'vue';
import {Head, Link} from '@inertiajs/vue3';
import moment from 'moment';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faTrash, faEdit} from '@fortawesome/free-solid-svg-icons'

library.add(faTrash, faEdit);

export default defineComponent({
    components: {
        FontAwesomeIcon,
        Head,
        Link,
    },
    props: {
        books: Object,
    },
    data() {
        var date = new Date();
        return {
            year: date.getFullYear(),
        }
    },
    methods: {
        format(param) {
            return moment(String(param)).format('DD/MM/YYYY LT')
        },
        delete_post(id) {
            if (confirm('Are you sure you want to delete this post?')) {
                this.$inertia.delete(`/posts/${id}`);
            }
        },
        expand_post(id) {
            this.$inertia.get(`/posts/${id}`);
        }
    }
})
</script>

<template>
    <Head title="Books"/>

    <div class="my-4 flex justify-center items-center">
        <div class="w-full flex justify-center items-center">
            <table class="w-3/5 table-auto border border-black text-center">
                <thead>
                <tr>
                    <th class="border border-black">Title</th>
                    <th class="border border-black">Author</th>
                    <th class="border border-black">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="book in books" :key="book">
                    <td class="border border-black">{{ book.title }}</td>
                    <td class="border border-black">{{ book.author.name }}</td>
                    <td class="border border-black flex justify-around">
                        <button>
                            <font-awesome-icon icon="fa-solid fa-edit"/>
                        </button>
                        <button>
                            <font-awesome-icon icon="fa-solid fa-trash"/>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>

</style>
