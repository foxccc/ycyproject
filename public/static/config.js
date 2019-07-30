require.config({
    urlArgs: "v=" + (new Date().getTime()),
    baseUrl: "/static/",
    paths: {
        "layui": ["plugs/layui-v2.5.4/layui"],
        "echarts": ["plugs/echarts/echarts.min"],
        "echarts-theme": ["plugs/echarts/echarts-theme"],
    }
});