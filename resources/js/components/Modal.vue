<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" v-if="title != ''">
                            <h5 class="modal-title">{{ title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" @click="$root.showModal[id] = false;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <slot name="content"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>


<script>
export default {
    props: {

        id: {
            type: String,
            required:true
        },
        title : {
            type: String,
            required: false
        }
    }
}
</script>
