@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
@section('contenidos')
        <style>
            .option-radio{
                font-size: 2.5rem;
            }
            input[type="radio"]{
                display: none;
            }
            .item-radio{
                cursor: pointer;    
            }
            .option-radio{           
                padding-left: 1rem;
            }
            input[type="radio"]:checked ~ label{
                color: #FE634E;
            }
        </style>
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header" >
                            <h2 class="card-title">Análisis de webs </h2>     
                                           
                        </div>
                        <div class="card-body" >     
                            <form class="row align-middle" id="form-search" action="">
                                <div class=" col-4 form-group">
                                    <label for="">Ingrese Url de web</label>
                                    <input type="text" name="url" id="inputUrl" value="{{-- https://getbootstrap.com/ --}}" required class="form-control" placeholder="">
                                </div>
                                <div class="col-4 m-0 d-flex items-center align-items-end form-group">                                  
                                    <div class="">
                                        <input id="mobile" type="radio" name="device" value="mobile" > 
                                        <label class="item-radio" for="mobile">
                                            <i class="option-radio flaticon-381-smartphone-3"></i>
                                            Mobile
                                        </label>
                                    </div>
                                    
                                    <div class="">
                                        <input type="radio" id="desktop" name="device" value="desktop" checked> 
                                        <label class="item-radio" for="desktop" >
                                            <i class="option-radio flaticon-381-news"></i>
                                            Desktop
                                        </label>
                                    </div>
                                </div>
                                <div class=" col-4 d-flex items-center align-items-end form-group">
                                    <button type="submit" id="btn-submit"  class="btn btn-success btn-round waves-effect">Buscar</button>
                                </div>  
                            </form>     
                                                                      
                                                      
                        </div>
                        <div class="card-footer" id="content-loading"">
                        </div>        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header d-flex  flex-row" >
                            <h2 class="card-title">web analizada: </h2>     
                            <h5 id="webAnalizada"></h5>                      
                            <h5 id="overallWeb" ></h5>
                        </div>
                     
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Largest Contentful Paint (LCP)</h2>
                            <div id="preloader2">                  
                            </div>
                        </div>
                        <div class="card-body" >                                                      
                            <div id="LargestContentFulPaint" class="gauge"></div>                            
                        </div>
                        <div class="card-footer text-center d-flex justify-content-between">
                            <h5 id="FooterLargestContentFulPaint" >                                
                            </h5>
                            <h6 id="FooterSecondsLargestContentFulPaint" ></h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header">                            
                            <h2 class="card-title">First Input Delay (FID)</h2>
                        </div>
                        <div class="card-body" >                                                      
                            <div id="FirstInputDelayMs" class="gauge"></div>                            
                        </div>
                        <div class="card-footer text-center d-flex justify-content-between">
                            <h5 id="FooterFirstInputDelayMs" >                                
                            </h5>
                            <h6 id="FooterSecondsFirstInputDelayMs" ></h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Cumulative Layout Shift (CLS)</h2>                            
                        </div>
                        <div class="card-body" >                                                      
                            <div id="CumulativeLayoutShiftScore" class="gauge"></div>
                            
                        </div>
                        <div class="card-footer  text-center d-flex justify-content-between">  
                            <h5 id="FooterCumulativeLayoutShiftScore" >                                
                            </h5>
                            <h6 id="FooterSecondsCumulativeLayoutShiftScore"></h6>                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">First Contentful Paint (FCP)</h2>
                            
                        </div>
                        <div class="card-body" >                                                      
                            <div id="FirstContentPaint" class="gauge"></div>
                            
                        </div>
                        <div class="card-footer text-center d-flex justify-content-between">
                            <h5 id="FooterFirstContentPaint" >                                
                            </h5>
                            <h6 id="FooterSecondsFirstContentPaint"></h6> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header">                            
                            <h2 class="card-title">server response </h2>
                        </div>
                        <div class="card-body" >                                                      
                            <div id="ExperimentalInteractionToNextPaint" class="gauge"></div>
                            
                        </div>
                        <div class="card-footer text-center d-flex justify-content-between">
                            <h5 id="FooterExperimentalInteractionToNextPaint" >                                
                            </h5>
                            <h6 id="FooterSecondsExperimentalInteractionToNextPaint"></h6> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card" >
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Speed Index</h2>                            
                        </div>
                        <div class="card-body" >                                                      
                            <div id="ExperimentalTimeToFirstByte" class="gauge"></div>                            
                        </div>
                        <div class="card-footer text-center d-flex justify-content-between">    
                            <h5 id="FooterExperimentalTimeToFirstByte" >                                
                            </h5>
                            <h6 id="FooterSecondsExperimentalTimeToFirstByte"></h6>                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="h4">
                                Resultados de auditoria
                            </div>
                            <h5 id="countAudit"></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="resultsAudit">
                {{-- <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body"></div>
                    </div>
                </div> --}}
            </div>
        </div>
   
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script>

<script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
<script>
        //  https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://google.com.pe/&key=AIzaSyA4AUnb1r96_etm6xSe0964bewq2padLcI

        let LargestContentFulPaint = new JustGage({            
            id: "LargestContentFulPaint",
            value: 0,
            percents: true,  
            min: 0,
            max: 100,  
            levelColors: ['#FF4E43', '#F5963F', '#FFA400', '#0CCE6A'],            
            symbol: '%',
            pointer: true,  
            decimals: 2,
            gaugeWidthScale: 0.6,
            relativeGaugeSize: true
            });

        let FirstInputDelayMs = new JustGage({            
            id: "FirstInputDelayMs",
            value: 0,
            percents: true,  
            min: 0,
            max: 100,  
            levelColors: ['#FF4E43', '#F5963F', '#FFA400', '#0CCE6A'],            
            symbol: '%',
            pointer: true,  
            decimals: 2,
            gaugeWidthScale: 0.6,
            relativeGaugeSize: true
            });

        let CumulativeLayoutShiftScore = new JustGage({            
            id: "CumulativeLayoutShiftScore",
            value: 0,
            percents: true,  
            min: 0,
            max: 100,  
            levelColors: ['#FF4E43', '#F5963F', '#FFA400', '#0CCE6A'],            
            symbol: '%',
            pointer: true,  
            decimals: 2,
            gaugeWidthScale: 0.6,
            relativeGaugeSize: true
            });

        let FirstContentPaint = new JustGage({            
            id: "FirstContentPaint",
            value: 0,
            percents: true,  
            min: 0,
            max: 100,  
            levelColors: ['#FF4E43', '#F5963F', '#FFA400', '#0CCE6A'],            
            symbol: '%',
            pointer: true,  
            decimals: 2,
            gaugeWidthScale: 0.6,
            relativeGaugeSize: true
            });

        let ExperimentalInteractionToNextPaint = new JustGage({            
            id: "ExperimentalInteractionToNextPaint",
            value: 0,
            percents: true,  
            min: 0,
            max: 100,  
            levelColors: ['#FF4E43', '#F5963F', '#FFA400', '#0CCE6A'],            
            symbol: '%',
            pointer: true,  
            decimals: 2,
            gaugeWidthScale: 0.6,
            relativeGaugeSize: true
            });
             
        let ExperimentalTimeToFirstByte = new JustGage({            
            id: "ExperimentalTimeToFirstByte",
            value: 0,
            percents: true,  
            min: 0,
            max: 100,  
            levelColors: ['#FF4E43', '#F5963F', '#FFA400', '#0CCE6A'],            
            symbol: '%',
            pointer: true,  
            decimals: 2,
            gaugeWidthScale: 0.6,
            relativeGaugeSize: true
            });
            
// const url ='https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://google.com.pe/&key=AIzaSyA4AUnb1r96_etm6xSe0964bewq2padLcI&locale=es&category=performance';

async function getDataCargaPagina(archiveJson=null, url = null, device) {
    const formatUrl = url === null? archiveJson : `https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=${url}&key=AIzaSyA4AUnb1r96_etm6xSe0964bewq2padLcI&locale=es&category=performance&strategy=${device}`;
    const response = await fetch(formatUrl)
                        .then((result) => {
                            // loadingNode.remove()
                            return result.json()}
                        )
                        .catch((err) => {
                            console.log("error "+err);
                        });
        const data = await response;
        return data;
    }
    async function start(data){    
        const idWebAnalizada = data.id;
        // console.log(data.lighthouseResult);
        /* if(data.originLoadingExperience === undefined){
            document.getElementById('countAudit').textContent = Object.keys(data.lighthouseResult.audits).length + " datos"
            paintAudit("resultsAudit", data.lighthouseResult.audits)            
            console.log(data.lighthouseResult.audits);
            return false;
        } */
        // return  console.log(data.lighthouseResult);
        // const overallWeb = data.originLoadingExperience.overall_category;
        const loadingExperienceMetrics=data.lighthouseResult.audits;

        // return console.log(data);

        const largestContentFulPaintMs=loadingExperienceMetrics["largest-contentful-paint"];
        const firstInputDelayMs = loadingExperienceMetrics["first-meaningful-paint"];
        const cumulativeLayoutShiftScore = loadingExperienceMetrics["cumulative-layout-shift"];
        const firstContentPaint = loadingExperienceMetrics["first-contentful-paint"];
        const serverResponseTime = loadingExperienceMetrics["server-response-time"];
        const experimentalTimeToFirstByte=  loadingExperienceMetrics["speed-index"];
        // return console.log(loadingExperienceMetrics);

        


        // const largestContentFulPaintMs=loadingExperienceMetrics.LARGEST_CONTENTFUL_PAINT_MS;
        // const firstInputDelayMs = loadingExperienceMetrics.FIRST_INPUT_DELAY_MS;
        // const cumulativeLayoutShiftScore = loadingExperienceMetrics.CUMULATIVE_LAYOUT_SHIFT_SCORE;
        // const firstContentPaint = loadingExperienceMetrics.FIRST_CONTENTFUL_PAINT_MS;
        // const experimentalInteractionToNextPaint = loadingExperienceMetrics.EXPERIMENTAL_INTERACTION_TO_NEXT_PAINT;
        // const experimentalTimeToFirstByte=  loadingExperienceMetrics.EXPERIMENTAL_TIME_TO_FIRST_BYTE;

        /* const dataLargestContentFulPaint = largestContentFulPaintMs.distributions;
        const dataFirstInputDelayMs = firstInputDelayMs.distributions;
        const dataCumulativeLayoutShiftScore = cumulativeLayoutShiftScore.distributions;
        const dataFirstContentPaint = firstContentPaint.distributions; */
        // const dataExperimentalInteractionToNextPaint = experimentalInteractionToNextPaint.distributions;
        // const dataExperimentalTimeToFirstByte = experimentalTimeToFirstByte.distributions;

        // return console.log(largestContentFulPaintMs);

        /* LARGEST_CONTENTFUL_PAINT_MS */
        const dataGreenLargest = (largestContentFulPaintMs.score * 100).toFixed(2);
        /* FIRST_INPUT_DELAY_MS */        
        const dataGreenFirst =  (firstInputDelayMs.score * 100).toFixed(2);
        /* CUMULATIVE_LAYOUT_SHIFT_SCORE */
        const dataGreenCumulativeLayoutShift = (cumulativeLayoutShiftScore.score * 100).toFixed(2);
        /* FIRST_CONTENTFUL_PAINT_MS */
        const dataGreenFirstContentPaint = (firstContentPaint.score * 100).toFixed(2);
        /* EXPERIMENTAL_INTERACTION_TO_NEXT_PAINT */
        const dataServerResponseTime = (serverResponseTime.score * 100).toFixed(2);
        /* EXPERIMENTAL_TIME_TO_FIRST_BYTE */
        const dataGreenExperimentalTimeToFirstByte = (experimentalTimeToFirstByte.score * 100).toFixed(2);

        
        LargestContentFulPaint.refresh(dataGreenLargest);
        FirstInputDelayMs.refresh(dataGreenFirst)
        CumulativeLayoutShiftScore.refresh(dataGreenCumulativeLayoutShift)
        FirstContentPaint.refresh(dataGreenFirstContentPaint)
        ExperimentalInteractionToNextPaint.refresh(dataServerResponseTime)
        ExperimentalTimeToFirstByte.refresh(dataGreenExperimentalTimeToFirstByte);
        // console.log(largestContentFulPaintMs);

        document.getElementById('webAnalizada').textContent= idWebAnalizada;
        
        const nodeOverallWerb = document.getElementById('overallWeb');
        // document.getElementById("myH2").style.color = "#ff0000";
        /* if(overallWeb === 'SLOW'){
            nodeOverallWerb.style.color = "#FF4E43";   
            nodeOverallWerb.textContent="Lento";         
        }   
        if(overallWeb === 'AVERAGE'){
            nodeOverallWerb.style.color = "#FFA400";     
            nodeOverallWerb.textContent="Por mejorar";         
        }  
        if(overallWeb === 'FAST'){
            nodeOverallWerb.style.color = "#0CCE6A";      
            nodeOverallWerb.textContent="Rapido";        
        }   */
        
        /* InnertHTML IN FOOTERS */
        document.getElementById('FooterLargestContentFulPaint').textContent = largestContentFulPaintMs.category;
        document.getElementById('FooterFirstInputDelayMs').textContent = firstInputDelayMs.category;
        document.getElementById('FooterCumulativeLayoutShiftScore').textContent = cumulativeLayoutShiftScore.category;
        document.getElementById('FooterFirstContentPaint').textContent = firstContentPaint.category;
        // document.getElementById('FooterExperimentalInteractionToNextPaint').textContent = experimentalInteractionToNextPaint.category;
        document.getElementById('FooterExperimentalTimeToFirstByte').textContent = experimentalTimeToFirstByte.category;

        // console.log(largestContentFulPaintMs);
        addTextPercentil(FooterSecondsLargestContentFulPaint, largestContentFulPaintMs.displayValue)
        addTextPercentil(FooterSecondsFirstInputDelayMs, firstInputDelayMs.displayValue)
        addTextPercentil(FooterSecondsCumulativeLayoutShiftScore, cumulativeLayoutShiftScore.displayValue)
        addTextPercentil(FooterSecondsFirstContentPaint, firstContentPaint.displayValue)
        // addTextPercentil(FooterSecondsExperimentalInteractionToNextPaint, experimentalInteractionToNextPaint.displayValue)
        addTextPercentil(FooterSecondsExperimentalTimeToFirstByte, experimentalTimeToFirstByte.displayValue)

        document.getElementById('countAudit').textContent = Object.keys(data.lighthouseResult.audits).length + " datos"
        paintAudit("resultsAudit", data.lighthouseResult.audits)
        // document.getElementById('FooterSecondsLargestContentFulPaint').textContent= largestContentFulPaintMs.percentile;

    }
    function paintAudit(node, data){
        // console.log(typeof(data));
        const container = document.getElementById(node);
        container.innerHTML="";

        for (const key in data) {
        //    data[key]
        container.innerHTML +=  `
                     <div class="col-md-3 grid-margin stretch-card">
                         <div class="card">
                             <div class="card-header d-flex justify-content-between">
                                 <h5>${data[key].title}</h5>    
                                 
                                 <p>${typeof (data[key].displayValue) === 'undefined' ? 'Consejo': data[key].displayValue } </p>
                             </div>
                             <div class="card-body">
                                 ${data[key].description}
                             </div>
                         </div>
                     </div> 
                 `
        }
    }
    function addTextPercentil(node, percentile) {
        const nodeText = document.getElementById(node);
        if(percentile>1000){
            return node.textContent= (percentile/1000).toFixed(1) + " s"
        }
        node.textContent= percentile + " ms"
    }

/* (async function(params) {
    const data = await getDataCargaPagina('/assets/json/dataPerformance.json'); 
    // console.log(JSON.stringify(data));
    start(data);
}()) */

 document.getElementById('form-search').addEventListener('submit', async (e)=>{
    e.preventDefault();    
    document.getElementById('content-loading').innerHTML = `
                                <div id='preloader2'>                    
                                <div class='sk-three-bounce'>
                                    <h4 class='text-center' >Cargando</h4>
                                    <div class='sk-child sk-bounce1'></div>
                                    <div class='sk-child sk-bounce2'></div>
                                    <div class='sk-child sk-bounce3'></div>
                                </div>
                            </div>`;
                            
    document.getElementById('btn-submit').disabled  = true;     
    const formData = new FormData(e.target);
    let obj = {};
    for (let key of formData.keys()) {
		obj[key] = formData.get(key);
	}
    const data = await getDataCargaPagina(null, obj.url, obj.device);  
    
    if (data.error) {        
        document.getElementById('preloader2').remove();
        document.getElementById('btn-submit').disabled  = false;
        return alert(data.error.message)
    }
    await start(data);

    document.getElementById('preloader2').remove();
    document.getElementById('btn-submit').disabled  = false;
 })
</script>
@endsection