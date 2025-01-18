$(function () {


  // =====================================
  // Profit
  // =====================================


  var chart_column_basic = new ApexCharts(
    document.querySelector("#profit"),
    profit
  );
  chart_column_basic.render();
  
  
  
    // =====================================
    // Breakup
    // =====================================
    
    
    var chart = new ApexCharts(document.querySelector("#grade"), grade);
    chart.render();
  
  
  
    // =====================================
    // Earning
    // =====================================
   
    new ApexCharts(document.querySelector("#earning"), earning).render();
  })