# Import APM package
include("../apm.jl")

# Solve optimization problem
sol = apm_solve("hs71",3)

println("--- Results of the Optimization Problem ---")
println("Solution Results")
println("  x[1] = " * string(sol["x[1]"]))
println("  x[2] = " * string(sol["x[2]"]))
println("  x[3] = " * string(sol["x[3]"]))
println("  x[4] = " * string(sol["x[4]"]))
