

async function getDataCitas() {
  const apiUrl = "/api/citas";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();
  let dataCitas = []; 
  dataChart.map(function(data) {
      return {  mes: new Date(data.fecha).toLocaleDateString('es-CO', 
                { month:"long", timeZone: 'UTC' }), 
                dateFull: new Date(data.fecha).toLocaleDateString('es-CO', {year:"numeric", month:"numeric", day:"numeric", timeZone: 'UTC' }),
                mesNumber: new Date(data.fecha).toLocaleDateString('es-CO', {month:"numeric", timeZone: 'UTC' }), 
                dayNumber: new Date(data.fecha).toLocaleDateString('es-CO', {day:"numeric", timeZone: 'UTC' }), 
                año: parseInt(new Date(data.fecha).toLocaleDateString('es-CO', {year:"numeric", timeZone: 'UTC' })),
                medico: data.medico.name} 
  }).forEach( (item) => {
    let position = dataCitas.findIndex( dataItem => dataItem.año == item.año )  
    // console.log(position);
    if( position != -1 ) {
      dataCitas[position].data.push( item )      
    } 
    else {
      let dataNewItem = {
        año: item.año,
        data:[ item ]
      }
      dataCitas.push( dataNewItem )
    }
  })
  return dataCitas;
}
async function getDataCitasEstados() {
  const apiUrl = "/api/citas/estado";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();
  let dataCitas = []; 
  dataChart.map(function(data) {
      return {  estado: data.estado,mes: new Date(data.fecha).toLocaleDateString('es-CO', 
                { month:"long", timeZone: 'UTC' }), 
                dateFull: new Date(data.fecha).toLocaleDateString('es-CO', {year:"numeric", month:"numeric", day:"numeric", timeZone: 'UTC' }),
                mesNumber: new Date(data.fecha).toLocaleDateString('es-CO', {month:"numeric", timeZone: 'UTC' }), 
                dayNumber: new Date(data.fecha).toLocaleDateString('es-CO', {day:"numeric", timeZone: 'UTC' }), 
                año: parseInt(new Date(data.fecha).toLocaleDateString('es-CO', {year:"numeric", timeZone: 'UTC' }))} 
  }).forEach( (item) => {
    let position = dataCitas.findIndex( dataItem => dataItem.año == item.año )  
    // console.log(position);
    if( position != -1 ) {
      dataCitas[position].data.push( item )      
    } 
    else {
      let dataNewItem = {
        año: item.año,
        data:[ item ]
      }
      dataCitas.push( dataNewItem )
    }
  })
  return dataCitas;
}
async function getDataUsuarios(){
  const apiUrl = "/api/usuarios";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();

  const dataCountAños = dataChart.map((element,position, array)=>{
    return new Date(element.created_at).toLocaleDateString('es-CO', 
    { year:"numeric", timeZone: 'UTC' });
    }).reduce((acc, element) => {
      acc[element] = acc[element] + 1 || 1
      return acc
      }, {}) 
    
  const dataCountRoles = dataChart.map((element,position, array)=>{
    return element.rol_id;
    }).reduce((acc, element) => {
      acc[element] = acc[element] + 1 || 1
      return acc
      }, {})
  
  
    return {
            countAños:dataCountAños,
            countRoles: dataCountRoles
      } 
}

async function getDataVentasAños(){
  const apiUrl = "/api/ventas";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();
  const ventas =  dataChart.map((element,position, array)=>{

            let data = new Date(element.created_at).toLocaleDateString('es-CO', 
            { year:"numeric", timeZone: 'UTC' });
            return array = data ;
    }).reduce((acc, element) => {
      acc[element] = acc[element] + 1 || 1
      return acc
    }, {})  
  return ventas;
}
async function getDataVentasSemana(){
  const apiUrl = "/api/ventas";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();
  const dateNew = new Date().toLocaleDateString('es-CO', {year:"numeric", month:"numeric", day:"numeric"})
  const yearActual= parseInt(dateNew.split("/")[2])
  const monthActual= parseInt(dateNew.split("/")[1])
  const dayActual= parseInt(dateNew.split("/")[0])
  let dataCountVentas = [];
  let data = dataChart.map(function (data) {
    let dataDay = new Date(data.created_at)
    let array=  {
      dateAll : dataDay.toLocaleDateString('es-CO',{year:"numeric", month:"numeric", day:"numeric", timeZone: 'UTC' }),
      dayStr: dataDay.toLocaleDateString('es-CO', {weekday: 'long' , timeZone: 'UTC' }),
      monthStr: dataDay.toLocaleDateString('es-CO', {month: 'long' , timeZone: 'UTC' }),
      monthNum: parseInt(dataDay.toLocaleDateString('es-CO', {month: 'numeric' , timeZone: 'UTC' })),
      dayNum: parseInt(dataDay.toLocaleDateString('es-CO', {day: 'numeric' , timeZone: 'UTC' })),
      yearNum: parseInt(dataDay.toLocaleDateString('es-CO', {year: 'numeric' , timeZone: 'UTC' })),
     }
     return array
    })
  .filter((element, position, array)=>{
    // console.log(element);
    if(element.yearNum === yearActual && element.monthNum === monthActual && element.dayNum <= dayActual)
    return element
    })
  .sort((a, b) => {
    return parseInt(b.dayNum) -parseInt(a.dayNum);
    })
  let dataCountVentasDias =[]
  data.forEach( item => {    
    let position = dataCountVentasDias.findIndex(element => element.dayNum == item.dayNum )  
    // console.log(position);
    if( position != -1 ) {
      dataCountVentasDias[position].data.push( item )      
    } else {
      let dataNewItem = {
        dayNum: item.dayNum,
        dayStr:item.dayStr,
        dateAll: item.dateAll,
        data:[item]
      }
      dataCountVentasDias.push( dataNewItem )
    }
  })
  const weekVentasDias = dataCountVentasDias.slice(0,7).map((element)=>{
    return array = {day:element.dayStr, count: element.data.length}
  }).reverse()
  return weekVentasDias
}
async function getDataVentasMeses(){
  const apiUrl = "/api/ventas";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();

  const dateNew = new Date().toLocaleDateString('es-CO', {year:"numeric", month:"numeric"})
  const yearActual= parseInt(dateNew.split("/")[1])


  const ventas = dataChart.map((element, position, array)=>{ 
    let dataDay = new Date(element.created_at)
    return array =  {
      dateAll : dataDay.toLocaleDateString('es-CO',{year:"numeric", month:"numeric", day:"numeric", timeZone: 'UTC' }),     
      monthStr: dataDay.toLocaleDateString('es-CO', {month: 'long' , timeZone: 'UTC' }),
      monthNum: parseInt(dataDay.toLocaleDateString('es-CO', {month: 'numeric' , timeZone: 'UTC' })),
      yearNum: parseInt(dataDay.toLocaleDateString('es-CO', {year: 'numeric' , timeZone: 'UTC' })),
     }
  }).filter((element, position, array)=>{
    // console.log(element);
    if(element.yearNum == yearActual) return element         
    })
    let dataCountVentasMeses =[]
    ventas.forEach( item => {    
      // console.log(typeof(item.monthNum));
      let position = dataCountVentasMeses.findIndex(element => element.monthStr === item.monthStr )  
      if( position != -1 ) {
        dataCountVentasMeses[position].data.push( item )      
      } else {
        let dataNewItem = {
          monthStr: item.monthStr,
          monthNum:item.monthNum,
          data:[item]
        }
        dataCountVentasMeses.push( dataNewItem )
      }
    })
    const dataVentasMeses = dataCountVentasMeses.map((element)=>{
         return {monthStr:element.monthStr, monthNum:element.monthNum, count: element.data.length}
    }).sort((a, b) => {
      return parseInt(a.monthNum) -parseInt(b.monthNum);
      })

  return dataVentasMeses;
}
async function getDataVentasClientes(){
  const apiUrl = "/api/ventas";
  const response = await fetch(apiUrl);
  const dataChart = await response.json();
  const ventas =  dataChart.map((element,position, array)=>{
            let data = new Date(element.created_at).toLocaleDateString('es-CO', 
            { year:"numeric", timeZone: 'UTC' });
            return array = data ;
    }).reduce((acc, element) => {
      acc[element] = acc[element] + 1 || 1
      return acc
    }, {})  
  return ventas;
}


async function fillCharts() {

  let citas = [];
  let citasEstatus = [];
  let ventasAños = []
  let ventasSemana = []
  let ventasMeses = []
  let usuarios = [];
    'use strict';
    citas = await getDataCitas();
    ventasAños = await getDataVentasAños()
    ventasSemana = await getDataVentasSemana();
    ventasMeses =  await getDataVentasMeses();
    usuarios = await getDataUsuarios();
    citasEstatus = await getDataCitasEstados()

    // usuariosRoles = await getDataUsuariosRoles();

  

    let generateColorsDate = function(array, transparent){
      const arrayCount = array.length;
      let arrayColors={};
      let colorTransparent = []
      let colorPure = []
      for (let index = 0; index < arrayCount ; index++) {
        // const r = Math.round( Math.random() * (254 - 223) + 223);     
        const r = (Math.floor(Math.random()*255)+1).toString();
        const g = Math.round( Math.random() * (100 - 80) + 80);
        const b = Math.round( Math.random() * (90 - 70) + 70);
       
        colorTransparent.push("rgba"+"("+r+","+g+","+b+", "+ transparent+")")
        colorPure.push("rgba"+"("+r+","+g+","+b+", "+"0.6"+")")
      }
      arrayColors['transparent'] = colorTransparent;
      arrayColors['pure'] = colorPure;
      return arrayColors
    };  

    // console.log(citas);
    let countCitasAños = citas.map((cita, posicion, array)=>{        
        return array = {año:cita.año , data:{año: cita.año, count: cita.data.length}}
    })
    // console.log(countCitasAños);
    let añoChart= []
    let mesChart = []
    let dayChart= []
    let backgroundColor= []


    /* Llenando datos de años, meses, dias, colores, 
    para usar en datos para grafico de registros de 
    citas por años */

      
    // const pruebaCitaPorMes = citas.fore
    const thisYear = new Date().getFullYear() ;
    citasGetCountMonth= citas.filter((value, element)=>{
            return thisYear == value['año'];
    })
  
    let dataCitasCountMonth = []; 
   
    citasGetCountMonth[0]['data'].forEach( (item) => {
      // console.log(item);
      let position = dataCitasCountMonth.findIndex( dataItem => dataItem.mes === item.mes )  
      // console.log(position);
      if( position != -1 ) {
        dataCitasCountMonth[position].data.push( item )      
      } 
      else {
        let dataNewItem = {
          mes: item.mes,
          mesNumber: item.mesNumber,
          data:[ item ]
        }
        dataCitasCountMonth.push( dataNewItem )
      }
    })
    
    citasCountYearNowMonth = {
      "mes": [],
      "conteo": []
    };

    /* Conteo de estados de citas */

    let dataCitasEstadoCountMonth = []; 
   
    citasEstatus[0]['data'].forEach( (item) => {
      // console.log(item);
      let position = dataCitasEstadoCountMonth.findIndex( dataItem => dataItem.mes === item.mes && dataItem.estado === item.estado )  
      // console.log(position);
      if( position != -1 ) {
        dataCitasEstadoCountMonth[position].data.push( item )      
      } 
      else {
        let dataNewItem = {
          estado: item.estado,
          mes: item.mes,
          mesNumber: item.mesNumber,
          data:[ item ]
        }
        dataCitasEstadoCountMonth.push( dataNewItem )
      }
    })
    // console.log(dataCitasEstadoCountMonth);



    citasCountEstadoNowMonth = {
      "estado": [],
      "conteo": []
    };
    // console.log(monthActual);
    const dateNow = new Date().toLocaleDateString('es-CO', {year:"numeric", month:"numeric", day:"numeric"})
    const monthActual= parseInt(dateNow.split("/")[1])
    
    dataCitasEstadoCountMonth.sort((a, b) => {
      return parseInt(a.estado) - parseInt(b.estado);
      }).forEach((element)=>{
      // console.log(monthActual == parseInt(element.mesNumber));     
        if(monthActual == parseInt(element.mesNumber)){
          citasCountEstadoNowMonth.estado.push(element.estado)
          citasCountEstadoNowMonth.conteo.push(element.data.length)
        }
    })
    changeToTextoEstadoNoMonth = citasCountEstadoNowMonth.estado.map((element)=>{
        if (element == 1) 
          return "Pendiente"
        if (element == 2)
          return "Triaje"
        if (element == 3)
          return "Diagnosticado"
    })

    const dataCountCitasYear2  = {          
      datasets: [{
        data: citasCountEstadoNowMonth.conteo,
        backgroundColor:[
          'rgb(255, 109, 77 )',
          'rgb(115, 86, 241)',
          'rgb(43, 193, 85)',]
          ,
      }],  
      labels : changeToTextoEstadoNoMonth        
    }


    //  console.log(dataCitasCountMonth);
    dataCitasCountMonth.sort((a, b) => {
      return parseInt(a.mesNumber) - parseInt(b.mesNumber);
      }).forEach((element)=>{
      citasCountYearNowMonth.mes.push(element.mes)
      citasCountYearNowMonth.conteo.push(element.data.length)
    })
    /* .sort((a, b) => {
      return parseInt(b.mesNumber) -parseInt(a.mesNumber);
      }) */
   
     citas.forEach((item,index,array)=>{
      let r = (Math.floor(Math.random()*255)+1).toString();
      let g = (Math.floor(Math.random()*15)+1).toString();
      let b = (Math.floor(Math.random()*47)+1).toString();
      let accumuladorDay = []
      let accumuladorColor = [];
      // console.log(item.data);
        if(item.data.length > 0){
          item.data.forEach((itemData)=>{   
              mesChart.push(itemData.mes)
              añoChart.push(itemData.año.toString())              
              accumuladorDay.push(parseInt(itemData.dayNumber))
              accumuladorColor.push("rgba"+"("+r+","+g+","+b+", 0.8)")
          })
          dayChart.push(accumuladorDay);
          backgroundColor.push(accumuladorColor)
        }else{          
          item.data.forEach((itemData)=>{
            añoChart.push(itemData.año.toString())            
            // console.log(itemData.medico);
             mesChart.push(itemData.mes)
             dayChart.push([parseInt(itemData.dayNumber)])
             backgroundColor.push("rgba"+"("+r+","+g+","+b+", 0.5)")
          })
        }
      });
      let countPositiom = 0
      let countPotionGeneralArray=0;
      const countMeses = mesChart.length;

    /* Creando data para grafico de registros de citas por años */
    let dataCitasAños = citas.map((item,position, array)=>{
      countPositiom++      
      countPotionGeneralArray=(countPotionGeneralArray+dayChart[position].length)-1
      return array = {
        label:item.año.toString(), 
        data : (function(params) {
          let emptyPostions = countMeses - dayChart[position].length;
          const isFirstItem = position == 0;
          const isLastItem = dayChart.length == countPositiom;                    
          if(isFirstItem){
            // console.log("Es primero");
            for (let i = 0; i <= (emptyPostions-1); i++) {
              dayChart[position].push(0)              
            }
            return dayChart[position];
          }
          if(isLastItem){
            let emptyPositions= countMeses - dayChart[position].length;
            // console.log("Es ultimo");
            for (let i = 0; i < emptyPositions; i++) {
              dayChart[position].unshift(0)              
            }
            return dayChart[position]
          }         
          let findIndexFirstValue = dayChart[position-1].reduce((acc, number, position)=>{
              if(number>0) acc = position;              
              return acc
          },0)
          for (let i = 0; i < findIndexFirstValue+1; i++) {
            dayChart[position].unshift(0)            
          }
          let emptyPositionsAfter = Math.abs(dayChart[position].length-countMeses)
          for (let i = 0; i < emptyPositionsAfter; i++) {
            dayChart[position].push(0)            
          }
          /* Comments    
          console.log("resta de conteo y posición "+(emptyPostions));
          console.log("Conteo de posicion de array general: "+ (countPositiom).toString());
          console.log(dayChart[position]);
          console.log("Posición en el array general "+countPotionGeneralArray);
          console.log("\n "); */
            return dayChart[position]
        }())/* ,
        getColors:(function(params) {
          console.log(array[position].data);
          
        }()) */
        , 
        backgroundColor: (function(params) {
            return backgroundColor[position];
        }()),  
        borderColor:backgroundColor[position],                 
        borderWidth: 2,
        fill: false,                          
        }
     }) 
    
    /* Creando data para grafico de conteo de citas por años */
        let countRegistrosCitasAños= []
        let countRegistrosCitasNumber = []
        let countRegistrosCitasColores = []
    countCitasAños.forEach((item, position, array)=>{
        const r = Math.round( Math.random() * (254 - 223) + 223);
        const g = Math.round( Math.random() * (100 - 80) + 80);
        const b = Math.round( Math.random() * (90 - 70) + 70);
        countRegistrosCitasAños.push((item.año).toString())        
        countRegistrosCitasNumber.push(item.data.count)        
        countRegistrosCitasColores.push("rgba"+"("+r+","+g+","+b+", 0.7)")
    });
    const colorsDataCitasAños = generateColorsDate(Object.keys(dataCitasAños),"0.3")
    const dataCountCitasAños  = {          
        datasets: [{
          data: countRegistrosCitasNumber,
          backgroundColor:colorsDataCitasAños.transparent,
          borderColor: colorsDataCitasAños.pure,
        }],  
        labels : countRegistrosCitasAños        
    }
    //A******************* AQUI ******************
    //objecAreaChart => datos de grafico de registros de citas por años
  
    /* let objecAreaChart = {
      labels: mesChart,
      datasets:dataCitasAños,
    }; */
    let objecAreaChart = 
    {
      labels: citasCountYearNowMonth['mes'],
      datasets: [{
        label: '2022',
        data: citasCountYearNowMonth['conteo'],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1,
        fill: false
      }]
    };

    let colorsVentasAños = function(array, transparent = "0.7"){
        const arrayCount = array.length;
        let arrayColors = []
        for (let index = 0; index < arrayCount ; index++) {
          const r = (Math.floor(Math.random()*242)+1).toString();          
          const g = (Math.floor(Math.random()*80)+1).toString();
          const b = (Math.floor(Math.random()*39)+1).toString();
          arrayColors.push("rgba"+"("+r+","+g+","+b+", "+ transparent+")")
        }
        return arrayColors
    };  

   

    const colorsDataVentasAños = generateColorsDate(Object.keys(ventasAños),"0.3")
    let dataVentasAños = {
      labels: Object.keys(ventasAños),
      datasets: [{
        data: Object.values(ventasAños),
        backgroundColor: colorsDataVentasAños.transparent,
        borderColor: colorsDataVentasAños.pure,
        borderWidth: 1,
        fill: true
      }    
        ]
    };

    /* Generando arrays de data Ventas Dias */
    let listVentasDias = [];
    let listVentasCount = [];
    ventasSemana.forEach((element)=>{
      listVentasDias.push(element.day)
      listVentasCount.push(element.count)
    })


    /* Generando arrays de data Ventas Meses */
    let listVentasMesesStr = [];
    let listVentasMesesCount = [];

    ventasMeses.forEach((element)=>{
      listVentasMesesStr.push(element.monthStr)
      listVentasMesesCount.push(element.count)
    })

    // console.log(listVentasMesesStr);
    // console.log(listVentasMesesCount);
    const colorsDataVentasSemana = generateColorsDate(Object.keys(ventasSemana),"0.3")
    let dataVentasSemana = {
      labels: listVentasDias,
      datasets: [{
        data: listVentasCount,
        backgroundColor: colorsDataVentasSemana.transparent,
        borderColor: colorsDataVentasSemana.pure,
        borderWidth: 2,
        fill: true
      }    
        ]
    };



    
    const colorsDataVentasMeses = generateColorsDate(Object.keys(ventasMeses),"0.3")
    let dataVentasMeses = {
      labels: listVentasMesesStr,
      datasets: [{
        data: listVentasMesesCount,
        backgroundColor: colorsDataVentasMeses.transparent,
        borderColor: colorsDataVentasMeses.pure,
        borderWidth: 2,
        fill: true
      }    
        ]
    };




    /* Generando data para chart usuarios */
    let listUsuariosAñosStr = [];
    let listUsuariosCountNum = [];


    listUsuariosAñosStr =Object.keys(usuarios.countAños);
    listUsuariosAñosNum = Object.values(usuarios.countAños)
    
  const colorsDataUsuariosAños = generateColorsDate(listUsuariosAñosNum,"0.3")
    let dataUsuariosCountAños = {
      labels: listUsuariosAñosStr,
      datasets: [{
        data: listUsuariosAñosNum,
        backgroundColor: colorsDataUsuariosAños.transparent,
        borderColor: colorsDataUsuariosAños.pure,
        borderWidth: 2,
        fill: true
      }    
        ]
    };

        /* Generando data para chart usuarios por roles */
        let listUsuariosRolesStr = [];


        listUsuariosRolesStr =Object.keys(usuarios.countRoles);
        UsuariosRolesCount = Object.values(usuarios.countRoles)

        
        DatalistUsuariosRolesStr = listUsuariosRolesStr.map((element)=>{
          if(parseInt(element) == 1) element = "Admin"
          if(parseInt(element) == 2) element = "Medico"
          if(parseInt(element) == 3) element = "Farmaceuta"
          if(parseInt(element) == 4) element = "Paciente"
          return element
        })

        
    const dataUsuariosRoles = {
      labels: DatalistUsuariosRolesStr,
      datasets: [{
        label: 'Rol',
        data: UsuariosRolesCount,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
        ],
        borderColor: [
          'rgba(255,99,132,1)'  ,
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
        ],
        borderWidth: 1,
        fill: false
      }     
        ]
    };

    var multiLineData = {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [{
          label: 'Dataset 1',
          data: [12, 19, 3, 5, 2, 3],
          borderColor: [
            '#587ce4'
          ],
          borderWidth: 2,
          fill: false
        },
        {
          label: 'Dataset 2',
          data: [5, 23, 7, 12, 42, 23],
          borderColor: [
            '#ede190'
          ],
          borderWidth: 2,
          fill: false
        },
        {
          label: 'Dataset 3',
          data: [15, 10, 21, 32, 12, 33],
          borderColor: [
            '#f44252'
          ],
          borderWidth: 2,
          fill: false
        }
      ]
    };
    var options = {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      }
  
    };
    var doughnutPieData = {
      datasets: [{
        data: [30, 40, 30],
        backgroundColor: [
          'rgba(255, 99, 132, 0.5)',
          'rgba(54, 162, 235, 0.5)',
          'rgba(255, 206, 86, 0.5)',
          'rgba(75, 192, 192, 0.5)',
          'rgba(153, 102, 255, 0.5)',
          'rgba(255, 159, 64, 0.5)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
      }],  
      labels: [
        'Pink',
        'Blue',
        'Yellow',
      ]
    };
    var doughnutPieOptions = {
      responsive: true,
      animation: {
        animateScale: true,
        animateRotate: true
      }
    };
    var areaData = {
      labels: ["2013", "2014", "2015", "2016", "2017"],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1,
        fill: true, // 3: no fill
      }]
    };
  
    var areaOptions = {
      plugins: {
        filler: {
          propagate: true
        }
      }
    }
  
    var multiAreaData = {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
          label: 'Facebook',
          data: [8, 11, 13, 15, 12, 13, 16, 15, 13, 19, 11, 14],
          borderColor: ['rgba(255, 99, 132, 0.5)'],
          backgroundColor: ['rgba(255, 99, 132, 0.5)'],
          borderWidth: 1,
          fill: true
        },
        {
          label: 'Twitter',
          data: [7, 17, 12, 16, 14, 18, 16, 12, 15, 11, 13, 9],
          borderColor: ['rgba(54, 162, 235, 0.5)'],
          backgroundColor: ['rgba(54, 162, 235, 0.5)'],
          borderWidth: 1,
          fill: true
        },
        {
          label: 'Linkedin',
          data: [6, 14, 16, 20, 12, 18, 15, 12, 17, 19, 15, 11],
          borderColor: ['rgba(255, 206, 86, 0.5)'],
          backgroundColor: ['rgba(255, 206, 86, 0.5)'],
          borderWidth: 1,
          fill: true
        }
      ]
    };
  
    var multiAreaOptions = {
      plugins: {
        filler: {
          propagate: true
        }
      },
      elements: {
        point: {
          radius: 0
        }
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          }
        }],
        yAxes: [{
          gridLines: {
            display: false
          }
        }]
      }
    }
  
    var scatterChartData = {
      datasets: [{
          label: 'First Dataset',
          data: [{
              x: -10,
              y: 0
            },
            {
              x: 0,
              y: 3
            },
            {
              x: -25,
              y: 5
            },
            {
              x: 40,
              y: 5
            }
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)'
          ],
          borderWidth: 1
        },
        {
          label: 'Second Dataset',
          data: [{
              x: 10,
              y: 5
            },
            {
              x: 20,
              y: -30
            },
            {
              x: -25,
              y: 15
            },
            {
              x: -10,
              y: 5
            }
          ],
          backgroundColor: [
            'rgba(54, 162, 235, 0.2)',
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
          ],
          borderWidth: 1
        }
      ]
    }
  
    var scatterChartOptions = {
      scales: {
        xAxes: [{
          type: 'linear',
          position: 'bottom'
        }]
      }
    }

    // Get context with jQuery - using jQuery's .get() method.
    if ($("#barChart").length) {
      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: dataUsuariosRoles,
        options: options
      });
    }
  
    /* Line Chart Ventas por años */
    if ($("#lineChart").length) {
      const lineChartCanvas = $("#lineChart").get(0).getContext("2d");
      const lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: dataVentasAños,
        options: options
      });
    }
    /* Line Chart Ventas por semana */
    if ($("#lineChart").length) {
      const lineChartCanvas = $("#lineChart2").get(0).getContext("2d");
      const lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: dataVentasSemana,
        options: options
      });
    }

    /* Line Chart Ventas por Meses */

    if ($("#lineChart").length) {
      const lineChartCanvas = $("#lineChart3").get(0).getContext("2d");
      const lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: dataVentasMeses,
        options: options
      });
    }

  
    if ($("#linechart-multi").length) {
      var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
      var lineChart = new Chart(multiLineCanvas, {
        type: 'line',
        data: multiLineData,
        options: options
      });
    }
  
    if ($("#areachart-multi").length) {
      var multiAreaCanvas = $("#areachart-multi").get(0).getContext("2d");
      var multiAreaChart = new Chart(multiAreaCanvas, {
        type: 'line',
        data: multiAreaData,
        options: multiAreaOptions
      });
    }
  
    if ($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart2").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: dataCountCitasYear2,
        options: doughnutPieOptions
      });
    }

    if ($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: dataCountCitasAños,
        options: doughnutPieOptions
      });
    }
  


    if ($("#pieChart").length) {
      var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
      var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: dataUsuariosCountAños,
        options: doughnutPieOptions
      });
    }
  
    if ($("#areaChart").length) {
      var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
      var areaChart = new Chart(areaChartCanvas, {
        type: 'line',
        data: objecAreaChart,
        options: {
          scales: {
            yAxes: [{
              scaleLabel: {
                display: true,
                fontFamily:"poppins",
              }
            }]
          }
        }
      });
    }
  
    if ($("#scatterChart").length) {
      var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
      var scatterChart = new Chart(scatterChartCanvas, {
        type: 'scatter',
        data: scatterChartData,
        options: scatterChartOptions
      });
    }
  
    if ($("#browserTrafficChart").length) {
      var doughnutChartCanvas = $("#browserTrafficChart").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: browserTrafficData,
        options: doughnutPieOptions
      });
    }
  };

fillCharts();