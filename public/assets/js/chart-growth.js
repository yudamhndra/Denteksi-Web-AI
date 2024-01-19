function chartTB(urlChart, idAnak) {
    const chart = new Chartisan({
        el: '#chart-tb',
        url: urlChart+"?id_anak=" + idAnak,
        hooks: new ChartisanHooks()
        .datasets([{ type: 'line', fill: false }]),
    });  
}