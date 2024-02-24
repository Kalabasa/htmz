// Footer animation generates fake URLs and fake containers

// prettier-ignore
const resources =
  "user,post,comment,product,order,file,location,event,task,invoice,employee,customer,review,article,note,song,album,booking,reservation,ticket,payment,transaction,message,conversation,tag,recipe,contact,subscription,profile,group,document,question,answer,notification,reminder,thread,book,project,folder".split(",");
const pathExts = ",,,,,,.html,.php,.asp,.jsp".split(",");
const listQueries = ",,page".split(",");
const singleQueries = ",%,%id,id,/".split(",");
const listUINames = "list,grid,table".split(",");
// prettier-ignore
const singleUINames =
  ",container,row,item,box,overlay,preview,form,tooltip,toast,chip,tooltip,tabview,dropdown,card,modal,pane,panel,tabpanel,dataview,view".split(",");

const footer = document.querySelector(".footer");
const footerSupports = footer.querySelectorAll("& > .support");

const animate = async () => {
  footerSupports[0].textContent = "";
  footerSupports[0].classList.remove("entering");
  footerSupports[0].classList.add("exiting");
  footer.classList.add("idle");
  footerSupports[1].textContent = "";
  footerSupports[1].classList.remove("entering");
  footerSupports[1].classList.add("exiting");
  await wait(200);

  const plural = Math.random() < 0.5;

  const resource = randomItemFrom(resources);

  const resourcePath = resource + (plural ? "s" : "");
  const pathExt = randomItemFrom(pathExts);
  const method = pathExt ? "GET" : randomItemFrom(["GET", "POST"]);
  let pathSuffix =
    pathExt !== ".html"
      ? plural
        ? randomItemFrom(listQueries)
        : randomItemFrom(singleQueries)
      : "";
  if (pathSuffix) {
    const int = 10 + Math.floor(Math.random() * 90);
    if (plural) {
      pathSuffix = `?${pathSuffix}=${int}`;
    } else {
      if (pathSuffix.endsWith("/")) {
        pathSuffix = pathSuffix + int;
      } else {
        pathSuffix = `?${pathSuffix.replace(/%/g, resource[0])}=${int}`;
      }
    }
  }

  const uiName = plural
    ? randomItemFrom(listUINames)
    : randomItemFrom(singleUINames);
  const separator = Math.random() < 0.33 ? "" : Math.random() < 0.5 ? "_" : "-";
  const formattedUIName = uiName && (separator ? uiName : uiName[0].toUpperCase() + uiName.slice(1));

  const resourceText = `${method} /${resourcePath}${pathExt}${pathSuffix}`;
  const containerText = `#${resource}${uiName && separator}${formattedUIName}`;

  footerSupports[0].textContent = resourceText;
  footerSupports[0].classList.add("entering");
  footerSupports[0].classList.remove("exiting");
  await wait(400);
  footer.classList.remove("idle");
  await wait(100);
  footerSupports[1].textContent = containerText;
  footerSupports[1].classList.add("entering");
  footerSupports[1].classList.remove("exiting");
  await wait(1600);
  animate();
};

animate();

function randomItemFrom(list) {
  return list[Math.floor(Math.random() * list.length)];
}

function wait(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}