<!--<script src="../app.js"></script>-->
<!--<template>-->
<!--    　　<div class="container">-->
<!--    　　　　<div class="row justify-content-center">-->
<!--    　　　　　　<div class="col-md-8">-->
<!--    　　　　　　　<div class="card">-->
<!--    　　　　　　　　　<div class="card-header">Example Component</div>-->

<!--    　　　　　　　　　<div class="card-body">-->
<!--    　　　　　　　　　　I'm an example component.-->
<!--    　　　　　　　　　</div>-->
<!--    　　　　　　　</div>-->
<!--    　　　　　　</div>-->
<!--    　　　　</div>-->
<!--    　　</div>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    mounted() {-->
<!--    }-->
<!--}-->
<!--</script>-->
<template>
<div class="row justify-content-center">
<ul>
    <li v-for="test in tests" :key="test.id">{{test.title}}</li>
</ul>
</div>
</template>

<script>
export default {
    props:["tests"]
}
</script>
