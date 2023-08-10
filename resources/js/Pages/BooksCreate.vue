<script>
import {defineComponent} from 'vue';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from '@fortawesome/fontawesome-svg-core'
import {faEdit, faEye, faTrash} from '@fortawesome/free-solid-svg-icons'
import {Head, Link, useForm} from "@inertiajs/vue3";

library.add(faTrash, faEdit, faEye);

export default defineComponent({
    components: {
        FontAwesomeIcon,
        Head,
        Link,
    },
    props: {
        authors: Object,
    },
    data() {
        const form = useForm({
            author_id: null,
            title: null,
        });
        var formDisabled = false;
        return {
            form,
            formDisabled
        }
    },
    methods: {
        submitCreate() {
            this.form.post('/books');
        },
        returnToIndex() {
            this.$inertia.get('/');
        }
    }
})
</script>

<template>
    <Head title="Books"/>

    <div class="my-4 flex justify-center items-center">
        <div class="w-full flex flex-col justify-center items-center">
            <div class="w-1/3">
                <form class="mx-10 my-10 flex flex-col" @submit.prevent="submitCreate()">
                    <label for="title">Book Title:</label>
                    <input id="title" v-model="this.form.title"
                           class="w-full h-12 p-1" name="title"
                           type="text">
                    <label for="author">Author Name:</label>
                    <select id="author" v-model="this.form.author_id"

                            class="w-full h-12 p-1" name="author">
                        <option v-for="author of authors" :value=author.id>{{
                                author.name
                            }}
                        </option>
                    </select>
                    <button
                        class="inline-flex text-md transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-current focus:outline-none rounded-md text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 w-1/3 mx-auto my-4">
                        Send
                    </button>
                    <button class="inline-flex text-md transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-current focus:outline-none rounded-md text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 w-1/3 mx-auto my-4"
                            @click="returnToIndex()">
                        Back
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
