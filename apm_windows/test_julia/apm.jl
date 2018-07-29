# install with Pkg.add("HTTPClient")
using HTTPClient.HTTPC
# install with Pkg.add("Compat")
#using Compat

function apm(server,app,aline)
  #=Send a request to the server \n \
  server = address of server \n \
  app      = application name \n \
  aline  = line to send to server \n=#
  response = "Failed to connect to server"
  try
    # Web-server URL address
    url_base = server * "/online/apm_line.php"
    app = lowercase(app)
    app = replace(app," ","")

    # Send request to web-server
    params = [("p",app), ("a",aline)]
    f = HTTPC.get(url_base,RequestOptions(query_params=params))
    response = strip(utf8(f.body.data))
  end
  return response
end

function apm_load(server,app,filename)
  #=Load APM model file \n \
  server   = address of server \n \
  app      = application name \n \
  filename = APM file name=#
  # Load APM File
  f = open(filename,"r")
  aline = readall(f)
  close(f)
  app = lowercase(app)
  app = replace(app," ","")
  response = apm(server,app," "*aline)
  return
end

function csv_load(server,app,filename)
  #=Load CSV data file \n \
  server   = address of server \n \
  app      = application name \n \
  filename = CSV file name=#
  # Load CSV File
  f = open(filename,"r")
  aline = readall(f)
  close(f)
  app = lowercase(app)
  app = replace(app," ","")
  response = apm(server,app,"csv "*aline)
  close(f)
  return
end

function apm_ip(server)
  #=Get current IP address \n \
  server   = address of server=#
  # get ip address for web-address lookup
  url_base = server * "/ip.php"
  f = HTTPC.get(url_base)
  ip = strip(utf8(f.body.data))
  return ip
end

function apm_t0(server,app,mode)
  #=Retrieve restart file \n \
  server   = address of server \n \
  app      = application name \n \
  mode = {"ss","mpu","rto","sim","est","ctl"} =#
  # Retrieve IP address
  ip = apm_ip(server)
  # Web-server URL address
  app = lowercase(app)
  app = replace(app," ","")
  url = server * "/online/" * ip * "_" * app * "/" * strip(mode) * ".t0"

  f = HTTPC.get(url)
  solution = strip(utf8(f.body.data))
  return solution
end

function apm_sol(server,app)
  #=Retrieve solution results\n \
  server   = address of server \n \
  app      = application name =#
  # Retrieve IP address
  ip = apm_ip(server)
  # Web-server URL address
  app = lowercase(app)
  app = replace(app," ","")
  url = server * "/online/" * ip * "_" * app * "/results.csv"

  f = HTTPC.get(url)
  solution = strip(utf8(f.body.data))
  solution = replace(solution,"\r","")

  # Write the file
  sol_file = "solution_" * app * ".csv"
  fh = open(sol_file,"w")
  # possible problem here if file isn"t able to open (see MATLAB equivalent)
  write(fh,solution)
  close(fh)

  # Import CSV solution file
  sol = readdlm(sol_file,',')
  n,m = size(sol)
  if m == 2
    y = (AbstractString => Float32)[sol[i,1]=>sol[i,2] for i in 1:n]
  else
    y = (AbstractString => Array)[sol[i,1]=>sol[i,2:m] for i in 1:n]
  end
  # Return solution
  return y
end

function apm_get(server,app,filename)
  #=Retrieve any file from web-server\n \
  server   = address of server \n \
  app      = application name =#
  # Retrieve IP address
  ip = apm_ip(server)
  # Web-server URL address
  app = lowercase(app)
  app = replace(app," ","")
  url = server * "/online/" * ip * "_" * app * "/" * filename

  f = HTTPC.get(url)
  file = strip(utf8(f.body.data))
  file = replace(file,"\r","")

  # Write the file
  fh = open(filename,"w")
  write(fh,file)
  close(fh)
  return (file)
end

function apm_option(server,app,name,value)
  #=Load APM option \n \
  server   = address of server \n \
  app      = application name \n \
  name     = {FV,MV,SV,CV}.option \n \
  value    = numeric value of option =#
  #aline = "option %s = %f" %(name,value)
  aline = "option " * name * "= $(value)"
  app = lowercase(app)
  app = replace(app," ","")
  response = apm(server,app,aline)
  return response
end

function apm_web(server,app)
  #=Open APM web viewer in local browser \n \
  server   = address of server \n \
  app      = application name =#
  # Retrieve IP address
  ip = apm_ip(server)
  # Web-server URL address
  app = lowercase(app)
  app = replace(app," ","")
  url = server * "/online/" * ip * "_" * app * "/" * ip * "_" * app * "_oper.htm"
  println("Open this link: " * url)
  #webbrowser.open_new_tab(url)
  return url
end

function apm_web_var(server,app)
  #=Open APM web viewer in local browser \n \
  server   = address of server \n \
  app      = application name =#
  # Retrieve IP address
  ip = apm_ip(server)
  # Web-server URL address
  app = lowercase(app)
  app = replace(app," ","")
  url = server * "/online/" * ip * "_" * app * "/" * ip * "_" * app * "_var.htm"
  println("Open this link: " * url)
  #webbrowser.open_new_tab(url)
  return url
end

function apm_web_root(server,app)
  #=Open APM root folder \n \
  server   = address of server \n \
  app      = application name =#
  # Retrieve IP address
  ip = apm_ip(server)
  # Web-server URL address
  app = lowercase(app)
  app = replace(app," ","")
  url = server * "/online/" * ip * "_" * app * "/"
  println("Open this link: " * url)
  #webbrowser.open_new_tab(url)
  return url
end

function apm_info(server,app,ctype,aline)
  #=Classify parameter or variable as FV, MV, SV, or CV \n \
  server   = address of server \n \
  app      = application name \n \
  type     = {FV,MV,SV,CV} \n \
  aline    = parameter or variable name =#
  x = "info" * " " *  ctype * ", " * aline
  app = lowercase(app)
  app = replace(app," ","")
  response = apm(server,app,x)
  return response
end

function apm_tag(server,app,name)
  #=Retrieve options for FV, MV, SV, or CV \n \
  server   = address of server \n \
  app      = application name \n \
  name     = {FV,MV,SV,CV}.{MEAS,MODEL,NEWVAL} \n \n \
  Valid name combinations \n \
  {FV,MV,CV}.MEAS \n \
  {SV,CV}.MODEL \n \
  {FV,MV}.NEWVAL =#
  # Web-server URL address
  url_base = server * "/online/get_tag.php"
  app = lowercase(app)
  app = replace(app," ","")
  params = [("p",app), ("n",name)]
  f = HTTPC.get(url_base,RequestOptions(query_params=params))
  value = parse(Float32,utf8(f.body.data))

  return value
end

function apm_meas(server,app,name,value)
  #=Transfer measurement to server for FV, MV, or CV \n \
  server   = address of server \n \
  app      = application name \n \
  name     = name of {FV,MV,CV} =#
  # Web-server URL address
  url_base = server * "/online/meas.php"
  app = lowercase(app)
  app = replace(app," ","")
  params = [("p",app), ("n",name*".MEAS"), ("v",value)]
  f = HTTPC.get(url_base,RequestOptions(query_params=params))
  response = strip(utf8(f.body.data))
  return response
end

function apm_solve(app,imode)
  #=
  APM Solver for simulation, estimation, and optimization with both
  static (steady-state) and dynamic models. The dynamic modes can solve
  index 2+ DAEs without numerical differentiation.

  y = apm_solve(app,imode)

  Function apm_solve uploads the model file (apm) and optionally
  a data file (csv) with the same name to the web-server and performs
  a forward-time stepping integration of ODE or DAE equations
  with the following arguments:

  Input:      app = model (apm) and data file (csv) name
  imode = simulation mode {1..7}
  steady-state  dynamic  sequential
  simulate     1             4        7
  estimate     2             5        8 (under dev)
  optimize     3             6        9 (under dev)

  Output: y.names  = names of all variables
  y.values = tables of values corresponding to y.names
  y.nvar   = number of variables
  y.x      = combined variables and values but variable
  names may be modified to make them valid
  characters (e.g. replace "[" with "")
  =#

  # server and application file names
  server = "http://127.0.0.1"
  app = lowercase(app)
  app = replace(app," ","")
  app_model = app * ".apm"
  app_data =  app * ".csv"

  # randomize the application name
  rn = abs(rand(Int32))
  app = app * "_$(rn)"

  # clear previous application
  apm(server,app,"clear all")

  try
    # load model file
    apm_load(server,app,app_model)
  catch error
    println("Model file " * app * ".apm does not exist")
    return []
  end

  # check if data file exists (optional)
  try
    # load data file
    csv_load(server,app,app_data)
  catch error
    # data file is optional
    println("Optional data file " * app * ".csv does not exist")
  end

  # default options
  # use or don't use web viewer
  web = false
  if web
    apm_option(server,app,"nlc.web",2)
  else
    apm_option(server,app,"nlc.web",0)
  end

  # internal nodes in the collocation (between 2 and 6)
  apm_option(server,app,"nlc.nodes",3)
  # sensitivity analysis (default: 0 - off)
  apm_option(server,app,"nlc.sensitivity",0)
  # simulation mode (1=ss,  2=mpu, 3=rto)
  #                 (4=sim, 5=est, 6=nlc, 7=sqs)
  apm_option(server,app,"nlc.imode",imode)

  # attempt solution
  solver_output = apm(server,app,"solve")

  # check for successful solution
  status = apm_tag(server,app,"nlc.appstatus")

  if status==1
    # open web viewer if selected
    if web
      apm_web(server,app)
    end
    # retrieve solution and solution.csv
    z = apm_sol(server,app)
    return z
  else
    println(solver_output)
    println("Error: Did not converge to a solution")
    return []
  end
end
