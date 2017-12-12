<template>
    <div class="panel panel-default">
        <div class="panel-body">

        </div>
        <div class="panel-footer">
            <div>
                <input type="text">
                <a href="" @click="onUpdate">Save</a>
                <a href="" @click="onCancel">Cancel</a>
            </div>
            <div>
                <a href="" @click="onEdit">Edit</a>
                <a href="" @click="onDelete">Delete</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['ns']
    }
</script>